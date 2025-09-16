/*!
 *Last modified: 2023-08-16 23:21:58
 *名称: axRate.js
 *简介: 评星插件的js文件
 *用法: new axRate('#id',{参数})
 *版本: v1.0.4
 *演示: https://www.axui.cn/v2.0/ax-rate.php
 *客服: 3217728223@qq.com
 *交流: QQ群952502085
 *作者: AXUI团队
 */
class axRate {
    constructor(elem, options) {
        this.targetDom = axIdToDom(elem);
        this.options = axExtend({
            insName: '',//实例名称，字符串格式；如果填写了实例名称，那么该实例会被添加到实例合集当中，通过axInstance方法可获取本实例，详细请查看：ax-utils-instance.php
            half: false, //是否支持半星选择，默认false不支持，可选择true支持
            icon: 'ax-iconfont ax-icon-star-f', //图标className
            count: 5, //评星总数，默认5星
            multiplier: 1, //1个星星代表的分数
            value: 0,  //初始化当前星级评分，默认为0，值小于等于count*multiplier
            readonly: false, //是否是只读模式，默认为false，可选择true只读（只展示不可操作）
            popShow: false, //是否显示星星节点气泡，默认false不显示，可选择true显示
            popTheme: 'ad', //气泡风格，与axTooltip的theme参数一致
            popFormat: '<i stars></i>星,总分:<i value></i>', //显示气泡的内容格式，
            tipsShow: false, //是否在末尾显示得分，默认false不显示，可选择true显示
            tipsFormat: '<i stars></i>星,总分:<i value></i>', //显示末尾得分文本格式，
            clearShow: false, //是否显示清楚星星按钮，默认false不显示，可选择true显示
            size: '',//星星尺寸，有三种尺寸18px的sm，28px的md和38px的lg，默认是sm
            rendered: '', //回调函数，初始化生成节点时执行
            getValue: '', //回调函数，获得值时执行，支持两个参数：当前值和当前星星数量
            setValue: '', //回调函数，设置值时执行，支持两个参数：当前值和当前星星数量
            breakpoints: {},//使用断点以适配终端，详情查看ax-utils-other.php页面
        }, options, this.targetDom, this.constructor.name);
        //回调监听
        this.handlers = {};
        if (!this.targetDom || this.targetDom.nodeName == 'INPUT') {
            this.parent = axAddElem('div', { class: 'ax-rate' });
            if (this.targetDom.nodeName == 'INPUT') {
                this.hidden = this.targetDom;
                this.hidden.insertAdjacentElement('beforeBegin', this.parent);
                this.hidden.type != 'hidden' ? this.hidden.style.display = 'none' : null;
            }
        } else {
            this.parent = this.targetDom;
        }
        //最终得分
        this.value = 0;
        //已经选择的星星数量
        this.stars = 0;
        //星星数组，包含dom，是否半星[id:'',value:'',dom:'',]
        this.items = [];
        this.init();
        return this;
    }
    init() {
        //添加到实例合集
        axInstance.push(this, this.options.insName, 'rate');
         //断点合并参数
         !axIsEmpty(this.options.breakpoints) ? axBreakpoints(this.options, this.options.breakpoints) : null;
        //创建dom节点
        this.renderRate();
        //根据value初始化星星
        this.set(this.options.value);
        //创建气泡节点
        let pop;
        if (this.options.popShow) {
            pop = axAddElem('div', { class: 'ax-rate-popcon' }, this.options.popFormat);
            //创建气泡
            this.tooltip = new axTooltip(this.items[0].dom, {
                trigger: 'none',
                theme: this.options.popTheme,
                content: pop,
            });
            //鼠标经过星星ul显示和隐藏气泡
            new axHover(this.ul, {
                enter: () => {
                    this.tooltip.popup.show()
                },
                leave: () => {
                    this.tooltip.popup.hide();
                },
                hold: this.tooltip.popup.targetDom,
            });
        }
         //只读便不能操作了
        if (!this.options.readonly) {
            //点击clear按钮重置
            this.clear.onclick = () => {
                this.set(0);
            }
             //鼠标经过、点击和离开操作
            this.items.forEach((item) => {
                let itemDom = item.dom,
                    firstChild = itemDom.firstElementChild,
                    before = this.items.filter(i => i.id < item.id),
                    after = this.items.filter(i => i.id > item.id);
                    //改变tooltip的位置
                if (this.options.popShow) {
                    //鼠标经过星星更新位置
                    new axHover(itemDom, {
                        enter: () => {
                            this.tooltip.popup.updatePosition(itemDom);
                        },
                    });
                }
                itemDom.onmousemove = (e) => {
                    let place = this.movePlace(e, itemDom);
                    //前方的都满星
                    before.forEach(i => {
                        i.dom.firstElementChild.classList.add('ax-full');
                        i.value = 1;
                    });
                    //自身半星和全星切换
                    if (place == 'half') {
                        firstChild.classList.remove('ax-full');
                        firstChild.classList.add('ax-half');
                    } else if (place == 'full') {
                        firstChild.classList.remove('ax-half');
                        firstChild.classList.add('ax-full');
                    }
                     //后方的都取消
                    after.forEach(i => {
                        i.dom.firstElementChild.classList.remove('ax-half');
                        i.dom.firstElementChild.classList.remove('ax-full');
                    });
                    //只计算pop的数值，不计算真正的value和stars
                    if (this.options.popShow) {
                        this.calculate(item, place, pop);
                    }
                     //通过点击确认值
                    itemDom.onclick = () => {
                        if (place == 'half') {
                            item.value = 0.5;
                        } else if (place == 'full') {
                            item.value = 1;
                        } else {
                            item.value = 0;
                        }
                        this.calculate(item, place);
                         //如果有结果提示则显示
                        if (this.options.tipsShow) {
                            this.tipsValue ? this.tipsValue.innerHTML = this.value : null;
                            this.tipsStars ? this.tipsStars.innerHTML = this.stars : null;
                        }
                         //回调
                        this.options.getValue && this.options.getValue.call(this, this.value, this.stars);
                        this.handlers.hasOwnProperty('getValue') ? this.emit('getValue', this.value, this.stars) : null;
                    }
                }
            });
            //离开DOM，根据value判断满星还是半星
            this.ul.onmouseleave = () => {
                this.set(this.value);
                //回调
                this.options.setValue && this.options.setValue.call(this, this.value, this.stars);
                this.handlers.hasOwnProperty('setValue') ? this.emit('setValue', this.value, this.stars) : null;
            }
        }
    }
    set(val) {
        //修正数值
        if (val <= 0) {
            val = 0;
        }
        if (val >= this.options.multiplier * this.options.count) {
            val = this.options.multiplier * this.options.count;
        }
        let stars = val / this.options.multiplier,
            beforeStars = Math.floor(stars),
            currentStar = stars - beforeStars;
        if (!this.options.half) {
            //如果不支持半星
            currentStar = 0;
        }
         //前面的全星
        if (!val) {
            this.items.forEach(i => {
                let dom = i.dom.firstElementChild;
                dom.classList.remove('ax-half');
                dom.classList.remove('ax-full');
                i.value = 0;
            });
        } else {
             //如果不为0
            for (let i = 0; i <= beforeStars - 1; i++) {
                let dom = this.items[i].dom.firstElementChild;
                dom.classList.remove('ax-half');
                dom.classList.add('ax-full');
                this.items[i].value = 1;
            }
        }
         //更新星星数量
        this.stars = beforeStars;
        //最后一个元素半星
        if (currentStar == 0.5) {
            let dom = this.items[beforeStars].dom.firstElementChild;
            dom.classList.remove('ax-full');
            dom.classList.add('ax-half');
            this.items[beforeStars].value = 0.5;
            this.stars += 0.5;
            //顺位，确保后面的星星取消
            beforeStars++;
        }
         //后面的取消星星
        for (let i = beforeStars; i < this.items.length; i++) {
            let dom = this.items[i].dom.firstElementChild;
            dom.classList.remove('ax-half');
            dom.classList.remove('ax-full');
            this.items[i].value = 0;
        }
         //更新当前值
        this.value = val;
        this.tipsValue ? this.tipsValue.innerHTML = val : null;
        this.tipsStars ? this.tipsStars.innerHTML = this.stars : null;
        this.hidden ? this.hidden.value = val : null;
    }
    get(attr) {
        //获得的星星数量，总分，几项星星dom，每个星星代表的分值
        let obj = { stars: this.stars, value: this.value, count: this.options.count, multiplier: this.options.multiplier };
        return obj[attr];
    }
    calculate(item, place, pop) {
         //因为星星是按顺序生成的，所以id也是按顺序的
        let before = this.items.filter(i => i.id < item.id),
            stars = before.length;
        if (place == 'half') {
            stars += 0.5;
        } else if (place == 'full') {
            stars++;
        }
        //如果仅仅是计算pop的数值，则不计算真正的value和stars
        if (pop) {
            pop.querySelector('[stars]').innerHTML = stars;
            pop.querySelector('[value]').innerHTML = this.options.multiplier * stars;
        } else {
            this.value = this.options.multiplier * stars;
            this.stars = stars;
        }
    }
    renderRate() {
        let fragment = document.createDocumentFragment(),
            star = `<i class="${this.options.icon}"></i>`,
            itemHTML = `<li class="ax-item">
                            ${star.repeat(2)}
                        </li>`;
                        //评分主体
        this.ul = axAddElem('ul');
         //结果提示
        this.tips = axAddElem('div', { class: 'ax-tips' }, this.options.tipsFormat);
        this.tipsStars = this.tips.querySelector('[stars]');
        this.tipsValue = this.tips.querySelector('[value]');
        //清除按钮
        this.clear = axAddElem('i', { class: 'ax-iconfont ax-icon-close-o-f', clear: '' });
        //先追加clear按钮
        this.options.clearShow ? fragment.appendChild(this.clear) : null;
         //按顺序创建节点数组
         for (let i = 1; i <= this.options.count; i++) {
            let itemDom = axStrToDom(itemHTML),
                obj = {
                    id: i,
                    value: 0,
                    dom: itemDom,
                };
                //追加
            this.items.push(obj);
            this.ul.appendChild(itemDom);
        }
        fragment.appendChild(this.ul);
        this.options.tipsShow ? fragment.appendChild(this.tips) : null;
         //给节点增加尺寸样式
        if (this.options.size) {
            this.parent.setAttribute('size', this.options.size);
        }
        this.parent.appendChild(fragment);
         //监听回调
        this.options.rendered && this.options.rendered.call(this);
        'rendered' in this.handlers ? this.emit('rendered', '') : null;
    }
    movePlace(e, node) {
        if (!this.options.half) {
            //如果不支持半星
            return 'full';
        }
        let leftOffset = node.getBoundingClientRect().left,
            rightOffset = node.getBoundingClientRect().right,
            half = ((rightOffset - leftOffset) / 2),
            halfOffset = leftOffset + ~~half,
            placement = 'full';
        if (e.clientX < halfOffset) {
            placement = 'half';
        }
        return placement;
    }
    on(type, handler) {
        axAddPlan(type, handler, this);
        return this;
    }
    emit(type, ...params) {
        axExePlan(type, this, ...params);
    }
    off(type, handler) {
        axDelPlan(type, handler, this);
        return this;
    }
}
(() => {
    document.querySelectorAll('[axRate]').forEach(element => {
        new axRate(element);
    });
})();