/*!
 *Last modified: 2023-08-16 23:21:58
 *名称: axTree.js
 *简介: tree树菜单的js文件
 *用法: new axTree('#id',{参数})
 *版本: v1.0.10
 *演示: https://www.axui.cn/v2.0/ax-tree.php
 *客服: 3217728223@qq.com
 *交流: QQ群952502085
 *作者: AXUI团队
 */
class axTree {
    constructor(targetDom, options) {
        //列表Dom
        this.targetDom = axIdToDom(targetDom);
        this.options = axExtend({
            insName: '',//实例名称，字符串格式；如果填写了实例名称，那么该实例会被添加到实例合集当中，通过axInstance方法可获取本实例，详细请查看：ax-utils-instance.php
            storageName: '',//存储名称，字符串格式；如果需要保存实例当前数据请设定唯一的值，比如：storageName:'mystorage001'
            toggle: true, //是否同时只显示一个父级菜单，默认是true，可选择false
            collapseAll: true, //是否折叠所有ul，默认是true：折叠，可选择false，全部展开
            disabled: [], //初始化后禁止哪些菜单check和select（可以展开），格式为id数组，填id值
            expanded: [], //初始化要展开的菜单，格式为id数组，填id值
            checked: [], //初始化要check的项，格式为id数组，填id值
            selected: [], //被点击选择成为焦点的分支，格式为id数组，填id值
            readonly: [], //设置只读项，不可点击label，也不能增删改，格式为id数组，填id值
            selectable: true,//是否可选择分支作为焦点，默认允许，可选择false
            oneSelected: true, //是否只能让一个分支成为选择焦点，默认是，可选择false便能使用多个选择焦点
            arrowIcon: ['ax-icon-right', 'ax-icon-right', 'ax-none'], //菜单箭头图标，分别是折叠和打开状态，默认两者一致
            clickLineTo: '',//点击分支行等同于什么，默认为空，填check表示等同checked项；填select等同select项

            parentIcon: ['ax-icon-folder', 'ax-icon-folder-open'], //父节点的图标，分别是未打开和打开状态
            childIcon: 'ax-icon-file-text', //子节点图标，只有一种状态
            iconShow: false, //是否显示前缀图标，包裹子节点和父节点的图表，默认是false，可使用true显示

            checkboxIcon: ['ax-icon-square', 'ax-icon-check-s', 'ax-icon-check-s-f'], //复选三种状态图标，分别是未勾选时、勾选部分和勾选全部
            radioIcon: ['ax-icon-circle', 'ax-icon-radio', 'ax-icon-radio-f'], //单选状态图标，分别是未勾选时、勾选部分和勾选全部
            checkShow: false, //是否显示单选和多选控件，默认false不显示
            checkType: 'checkbox', //如果显示check，那么需要选择check的类型是checkbox还是radio
            checkMin: 0, //可check的最少数量，默认为0，即不限制
            checkMax: 1000000, //可check的最多数量，默认不限制，checkType: 'radio'+checkNum:1表示整个树菜单只能选一个
            linkage: true, //父层子层是否checked联动，对于radio类型，子项有一个选择就等于父层checked=ing；对于checkbox类型，子类全部选中，父层也选中了
            oneRadio: false, //单选排斥的范围，false表示在兄弟节点之间只能选一个，true表示在整个tree只能选一个

            url: '', //异步追加菜单地址，html格式，填写举例：'/a/b/ajax.html'

            inputWidth: '', //input和select的固定宽度，默认是92px

            toolsShow: false, //是否显示增删改工具，默认为false不显示，可选择true显示，与toolsAction参数搭配使用
            toolsAction: 'hover', //增删改工具的显示方式，默认是hover即经过name时显示，可选择click点击name显示或sticky直接显示
            addTools: [], //增加操作方法，举例：[{dom:'&lt;i class="ax-iconfont ax-icon-copy">&lt;/i>',callback:function(){}},...]，数组格式

            rootStart: -1, //顶层的编号,数字类型,通常是0或-1
            idStart: 0,//id开始编号，数字类型；如果从物理节点创建菜单，则需要自动创建项目id，默认第一项id为0

            draggable: false, //是否可拖拽，默认false不可拖拽，可使用true启用拖拽，如果需要对某些节点指定可拖拽，可以添加id数组

            line: false, //是否显示连线，默认不显示，可使用true显示连线


            async: '', //异步方式，选择从json文件获取数组数据，或选择sql从数据库获得数据
            ajaxType: 'post', //异步提交的方式，默认post，可填get
            delay: 0, //异步分页内容时延时加载
            fields: '', //使用其他的字段，生成的tree之后显示更多的内容，不仅仅是name，数组格式

            content: '', //数据源，支持三种数据类型，说明如下：
            //1、其他ul的#id或节点，ul+li将转成tree数组
            //2、页面数组变量，该数组可以是带pId的一维数组或带children的tree数组
            //3、地址字符串，在启用async前提下，可填json地址或动态页面地址
            //4、如果本身就是ul+li结构并满足插件物理节点要求，则该参数可为空

            display: 'inline',//展示方式，默认inline即将tree写入某个容器；可选择popup
            popup: {},//该参数设置popup的参数。如果display值为popup，则可设置该参数
            output: {
                enable: false,//是否是可赋值的，如果为true则button节点将作为输入元素接收tree值
                connector: '/',//输出路径值链接符，对type=chain有效
                type: '',//输出值类型，默认为空即输出所checked的项label；ultimate即输出终极项的label文本；chain即输出整个层级链条（path）；parent只输出父节点（多个）
                from: 'checked',//从哪类原生获得数据源，默认checked元素，可选selected
                receiver: '',//接收值的节点，可填#id、.className、nodeName或节点
                separator: ',',//输出多值的分隔符，默认为英文逗号
                prop: 'label',//取值属性，默认从label属性取值，如果数据有value属性可填value
            },
            breakpoints: {},//使用断点以适配终端，详情查看ax-utils-other.php页面
            onBeforeRemove: '',//删除前等待函数，支持参数obj（节点对象）和dom（节点本身），返回true或false，如果返回true则将删除节点，返回false将停止操作；如果回调中有异步操作需要手动使用this.remove(item)方法删除节点
            onGetCheckeds: '', //触发checked后的回调函数，支持两个参数arr和target，arr参数为当前checked=true的项目数组，target为当前节点
            onInit: '',//回调函数，初始化后执行，无参数
            onCollapse: '',//回调函数，节点折叠前执行，支持参数obj，即当前折叠的节点对象
            onExpand: '',//回调函数，节点展开前执行，支持参数obj，即当前展开的节点对象
            onCollapsed: '',//回调函数，节点折叠后执行，支持参数obj，即当前折叠的节点对象
            onExpanded: '',//回调函数，节点展开后执行，支持参数obj，即当前展开的节点对象
            onCollapseAll: '',//回调函数，节点全部折叠后执行，无参数
            onExpandAll: '',//回调函数，节点全部展开后执行，无参数
            onSetReadonly: '',//回调函数，设置节点只读后执行，支持参数items，即当前设置只读的对象数组
            onSetDisabled: '',//回调函数，设置节点禁止勾选后执行，支持参数items，即当前设置禁止勾选的对象数组
            onSetChecked: '',//回调函数，设置节点勾选后执行，支持参数items，即当前设置勾选的对象数组
            onSearched: '',//回调函数，关键字搜索后执行，支持参数items和value，即当前检索结果数组和关键字
            onRemoved: '',//回调函数，删除节点后执行，支持参数item，即当前删除的节点对象
            onEditing: '',//回调函数，正在编辑执行，支持参数item，即当前编辑的节点对象
            onEdited: '',//回调函数，编辑节点后执行，支持参数item，即当前编辑的节点对象
            onAdded: '',//回调函数，新增节点后执行，支持参数obj和target，即新增的节点对象和当前要操作的节点对象
            onSelected: '',//回调函数，高亮节点后执行，支持参数item，即当前高亮的节点对象
            onPlanted: '',//回调函数，tree节点生成后执行，无参数
            onChecked: '',//回调函数，点击勾选后执行，支持参数target和checkeds，即当前tree的当前要操作的节点对象和所有checked节点数组
            onDropped: '',//回调函数，拖拽完成后执行，支持参数insert和target，即拖拽过来的节点对象和当前要操作的节点对象
            onTooMuch: '',//回调函数，checked数量太多后执行，支持length和max，即当前checked节点数量和允许的最多数量
            onTooLittle: '',//回调函数，checked数量太少后执行，支持length和min，即当前checked节点数量和要求最少数量
            onDestroy: '',//回调函数，销毁后执行，无参数
            onSave: '',//回调函数，保存数据后执行，支持一个参数即localstorage值
            onUpdate: '',//回调函数，参数更新后执行，无参数
            onUpdateContent: '',//回调函数，子项内容更新后执行，支持一个参数即当前更新项
        }, options, this.targetDom, this.constructor.name);
        //监听事件
        this.handlers = {};
        //初始化
        this.init();
        return this;
    }
    begin() {
         //断点合并参数
         !axIsEmpty(this.options.breakpoints) ? axBreakpoints(this.options, this.options.breakpoints) : null;
        //修正的checked
        this.checked = [];
        //当前所有checked=true的项
        this.checkeds = [];
        //修正的expand
        this.expanded = [];

        //selected成员
        this.selected = this.options.selected;
        if (this.options.oneSelected && !axIsEmpty(this.selected)) {
            //如果填了多个selected值，但是oneSelected=true，那么只取第一个值
            this.selected.shift();
        }

        //disabled成员
        this.disabled = this.options.disabled;

        //判断箭头图标是否相同，如果相同则启用旋转90度动画
        this.arrowSame = this.options.arrowIcon[0] == this.options.arrowIcon[1] ? true : false;
        this.arrow = axAddElem('i', { class: 'ax-iconfont', arrow: '' });

        //check控件
        this.checkIcon = {
            checkbox: [
                '<i class="ax-iconfont ' + this.options.checkboxIcon[0] + '" check></i>',
                '<i class="ax-iconfont ' + this.options.checkboxIcon[1] + '" check></i>',
                '<i class="ax-iconfont ' + this.options.checkboxIcon[2] + '" check></i>'
            ],
            radio: [
                '<i class="ax-iconfont ' + this.options.radioIcon[0] + '" check></i>',
                '<i class="ax-iconfont ' + this.options.radioIcon[1] + '" check></i>',
                '<i class="ax-iconfont ' + this.options.radioIcon[2] + '" check></i>'
            ],
        };
        //文件图标
        this.fileIcon = '';
        if (this.options.iconShow) {
            this.fileIcon = {
                parent: '<i class="ax-iconfont ' + this.options.parentIcon[0] + '" legend></i>',
                child: '<i class="ax-iconfont ' + this.options.childIcon + '" legend></i>'
            }
        }

        //当前所有selected=true的项
        this.selecteds = [];
        //当前所有disabled=true的项
        this.disableds = [];
        //所有的检索项
        this.searchs = [];
        //所有只读项
        this.readonlys = [];
        //当前所有expand=true的项
        this.expandeds = [];
        //tree数组最深层级
        this.floorMax = 0;
        //最大索引
        this.maxIndex = this.options.idStart;
        //原始HTML
        this.rawHTML = '';
        //接收值按钮
        if (this.options.display === 'popup') {
            //气泡方式，接收器就是打开popup的按钮
            this.receiver = this.targetDom;
            //强制允许赋值
            this.options.output.enable = true;
            //设置可读
            this.receiver.nodeName === 'INPUT' || this.receiver.nodeName === 'TEXTAREA' ? this.receiver.setAttribute('readonly', '') : null;
            //改变targetDom
            this.targetDom = axAddElem('ul', { class: 'ax-tree' });
            //创建气泡实例
            this.popup = new axPopup(this.receiver, axExtend({
                content: this.targetDom,
                placement: 'bottom-start',
                footerShow: false,
            }, this.options.popup));
        } else {
            this.receiver = this.options.output.enable && this.options.output.receiver ? axIdToDom(this.options.output.receiver) : null;
        }
        //初始化数据
        this.flatData = [];
        this.treeData = [];
    }
    async init() {
        //添加到实例合集
        axInstance.push(this, this.options.insName, 'tree');
        //设置销毁状态
        this.destroyed = false;
        //判断是否有存储值而更新参数
        if (this.options.storageName) {
            //如果有保存数据则更新参数
            let storageVal = axLocalStorage.get(this.options.storageName);
            if (!axIsEmpty(storageVal)) {
                //参数与存储值合并，更新了参数
                this.options = axExtend(this.options, storageVal);
            } else {
                //则先存下空对象
                axLocalStorage.set(this.options.storageName, {});
            }
        }
        //初始化归零设置
        this.begin();
        //源tree数据
        if (axType(this.options.content) == 'String' && this.options.async) {
            //异步数据
            await axTreeMethod.getFullData({
                source: this.options.content,
                ajaxType: this.options.ajaxType,
                ajaxData: this.options.async === 'sql' ? { pId: this.options.rootStart } : '',
                rootStart: this.options.rootStart,
                idStart: this.options.idStart,
                async: true,
                opened: (response) => {
                    this.contentXhr = response.xhr;
                },
                before: (response) => {
                    this.targetDom.innerHTML = response.content;
                },
                success: () => {
                    this.targetDom.innerHTML = '';
                }
            }).then((result) => {
                this.treeData = result.data;
            });
        } else {
            //同步数据
            if (axType(this.options.content) === 'Array') {
                if (this.options.content.length === 0) {
                    console.warn('Array is empty!');
                    return false;
                }
                await axTreeMethod.getFullData({
                    source: this.options.content,
                    rootStart: this.options.rootStart,
                    idStart: this.options.idStart,
                }).then((result) => {
                    this.treeData = result.data;
                });
                //this.toTree(this.options.content);
            } else if (axType(this.options.content).includes('HTML') || axStrType(this.options.content)) {
                //node节点，从ul+li获取数据，不要value值所以为false
                await axTreeMethod.getFullData({
                    source: this.options.content,
                    rootStart: this.options.rootStart,
                    idStart: this.maxIndex,
                }).then((result) => {
                    this.treeData = result.data;
                    this.maxIndex = result.idMax;
                });
            } else if (this.targetDom.innerHTML) {
                //target节点本身，不要value值所以为false
                await axTreeMethod.getFullData({
                    source: this.targetDom,
                    rootStart: this.options.rootStart,
                    idStart: this.maxIndex,
                }).then((result) => {
                    this.treeData = result.data;
                    this.maxIndex = result.idMax;
                });
                this.rawHTML = this.targetDom.innerHTML;
            }
        }
        //根据数据执行剩余代码
        this.dataProcess(this.treeData);
    }
    //从数据库中获得数据
    getAsyncData(type = 'json', callback) {
        return axAjax({
            //根据参数进行数据扩展
            data: type === 'sql' ? { pId: this.options.rootStart } : '',
            url: this.options.content,
            type: this.options.ajaxType,
            opened: (response) => {
                this.contentXhr = response.xhr;
            },
            success: (response) => {
                if (axIsEmpty(response.content)) {
                    console.warn(`No data obtained from ${type === 'sql' ? 'database' : 'json'}!`);
                    return false;
                }
                this.toTree(response.content);
                callback && callback(response.content);
            }
        }, this.targetDom);
    }
    toTree(data) {
        if (data[0].hasOwnProperty('pId')) {
            //带pId的一维数组数据
            this.treeData = axArrToTree(data, this.options.rootStart);
        } else {
            //带children的多维数组
            this.treeData = data;
        }
    }
    dataProcess(data) {
        //拍平后的一纬数组
        this.flatData = axArrToFlat(data);

        //清理掉内容，将在后续重新生成
        this.targetDom.innerHTML = '';

        //新增节点id的数值，从现有id最大值开始
        //axIncreaseId(this.flatData);

        //给dom设置系列属性
        this.setAttribute();

        //根据原始的flatData修正checked参数，选择数超过checkMax，则自动截取this.checked参数
        if (!this.fixChecked(this.flatData)) {
            //如果是radio类型，同一层级却有两个或以上checked，那么将返回错误
            //如果选择数量少于checkMin，那么返回错误
            return false;
        }
        //更新树数据,this.treeData(树状对象数组)和this.flatData(拍平为一维数组)
        // this.refreshTree(data);
        //根据带path属性的flatData修正expand参数，生成this.expandeds
        this.fixExpand(this.flatData)

        //根据树数据创建树节点
        this.arrayToDom(data);

        this.flatData.forEach((item) => {
            //如果expand参数为空，并且设置全部展开，则执行全部展开
            if (axIsEmpty(this.expanded) && !this.options.collapseAll && item.children) {
                item.expanded = false;
                this.ulToggle(item);
            }
            //点击展开和折叠，单选复选，增删改操作
            this.renderFinish(item, this.flatData);
        });
        //监听回调
        this.options.onInit && this.options.onInit.call(this);
        'init' in this.handlers ? this.emit('init', '') : null;
    }
    setAttribute() {
        //给dom设置line属性
        if (this.options.line) {
            this.targetDom.setAttribute('line', '');
        }
        //追加ax-tree
        !this.targetDom.classList.contains('ax-tree') ? this.targetDom.classList.add('ax-tree') : null;
    }
    dragPlace(e, node) {
        let topOffset = node.getBoundingClientRect().top,
            bottomOffset = node.getBoundingClientRect().bottom,
            oneThird = ((node.getBoundingClientRect().bottom - node.getBoundingClientRect().top) / 3),
            upOffset = topOffset + ~~oneThird,
            downOffset = bottomOffset - ~~oneThird,
            placement = 'child';
        if (e.clientY < upOffset) {
            placement = 'up';
        } else if (e.clientY > downOffset) {
            placement = 'down';
        }
        return placement;
    }
    resetRelation(item, parent, oldParent, moveTo) {
        let setValue = (obj, target) => {
            if (moveTo == '1-0') {
                //移到顶级
                obj.pId = this.options.rootStart;
                obj.path = this.options.rootStart + '>' + obj.id;
                obj.floor = 1;
                obj.indentDom.innerHTML = '';
            } else if (moveTo == '0-1' || moveTo == 'other' || !moveTo) {
                //从顶级往下移
                obj.pId = target.id;
                obj.path = target.path + '>' + obj.id;
                obj.floor = target.floor + 1;
                obj.indentDom.innerHTML = '<i></i>'.repeat(obj.floor - 1);
            } else {
                //0-0
                //如果是在一级的兄弟节点之间转移则不改变obj属性了
            }
        }
        //有子节点则遍历
        let eachTraverse = (obj, target) => {
            if (obj.children && obj.children.length > 0) {
                obj.children.forEach(i => {
                    setValue(i, obj);
                    eachTraverse(i, obj);
                });
            } else {
                setValue(obj, target);
            }
        };
        setValue(item, parent);
        eachTraverse(item, parent);
        //更新原父子结构
        if (moveTo == '0-1') {
            //从顶级往下移
            //更新treeData，如果是一级节点变更为二级节点（或以下），删掉原一级
            this.treeData = this.treeData.filter(i => i.id != item.id);
        } else if (moveTo == '0-0') {
            //在顶级兄弟之间移动
        } else if (moveTo == '1-0') {
            //移动到顶层，与顶层节点是兄弟元素，也就是pId=0
        } else {
            //移到顶级或者moveTo == 'other'
            oldParent.children = oldParent.children.filter(i => i.id != item.id);
        }

    }
    openParentBorn(item, insert, oldParent, moveTo) {
        let ul = item.headerDom.nextElementSibling;

        if (insert) {
            //如果有插入的节点
            let insertLi = insert.headerDom.parentElement;
            //拖入的子节点修改属性
            this.resetRelation(insert, item, oldParent, moveTo);
            if (!item.expanded) {
                //如果是未展开状态则展开
                item.headerDom.setAttribute('expanded', 'true');
                item.expanded = true;
                ul.style.display = 'block';
            }
            item.children.unshift(insert);
            //最终插入ul
            ul.insertAdjacentElement('afterBegin', insertLi);
        }
    }
    childToParentBorn(item, insert, oldParent, moveTo) {
        if (item.children) {
            return false;
        } else {
            let ul = axAddElem('ul', { style: 'display:block' });
            item.arrowDom.classList.remove(this.options.arrowIcon[2]);
            item.arrowDom.classList.add(this.options.arrowIcon[0]);
            //拖入的父节点修改属性
            item.headerDom.setAttribute('expanded', 'true');
            item.expanded = true;
            item.children = [];
            if (insert) {
                //保留draggable属性
                let insertLi = insert.headerDom.parentElement;
                //拖入的子节点修改属性，如果有子节点那么也循环修改
                this.resetRelation(insert, item, oldParent, moveTo);
                item.children.unshift(insert);
                //修改节点
                ul.insertAdjacentElement('afterBegin', insertLi);
            }
            //最终插入ul
            item.headerDom.insertAdjacentElement('afterEnd', ul);
            item.arrowDom.onclick = () => {
                this.ulToggle(item);
            }

        }

    }
    dropItem(item, insert, oldParent, placement, moveTo) {
        let insertDom = insert.headerDom,
            insertLi = insertDom.parentElement,
            itemParent = this.flatData.filter(i => item.pId == i.id.toString())[0],
            itemLi = item.headerDom.parentElement,
            insertPlace = (placement == 'up') ? 'beforeBegin' : (placement == 'down') ? 'afterEnd' : '',
            newNode = (place) => {
                //向上拖入兄弟节点
                this.resetRelation(insert, itemParent, oldParent, moveTo);
                if (moveTo == '0-0') {
                    let insertIndex = this.treeData.indexOf(insert),
                        itemIndex = this.treeData.indexOf(item);
                    //顶级平移
                    if (place == 'up') {
                        axMoveArr(this.treeData, insertIndex, itemIndex);
                    } else if (place == 'down') {
                        axMoveArr(this.treeData, insertIndex, itemIndex + 1);
                    }
                } else if (moveTo == '1-0') {
                    //二级以下移到顶级
                    let itemIndex = this.treeData.indexOf(item),
                        index;
                    if (place == 'up') {
                        index = itemIndex;
                    } else if (place == 'down') {
                        index = itemIndex + 1;
                    }
                    this.treeData.splice(index, 0, insert);
                } else {
                    //0-1,顶级移到二级以下或二级以下相互移动
                    let itemIndex = itemParent.children.indexOf(item),
                        index;
                    if (place == 'up') {
                        index = itemIndex;
                    } else if (place == 'down') {
                        index = itemIndex + 1;
                    }
                    itemParent.children.splice(index, 0, insert);
                }
                //在新地方插入节点
                itemLi.insertAdjacentElement(insertPlace, insertLi);
            };
        //根据鼠标位置生成新节点
        if (placement == 'up') {
            //如果上一个节点正好是要插入的节点，那么停止执行
            if (itemLi.previousElementSibling == insertLi) {
                return false;
            }
            //向上拖入兄弟节点
            newNode('up');
        } else if (placement == 'down') {
            //如果下一个节点正好是要插入的节点，那么停止执行
            if (itemLi.nextElementSibling == insertLi) {
                return false;
            }
            //向下拖入兄弟节点
            newNode('down');
        } else {
            //创建子节点
            if (item.children) {
                //附着的节点已经是父节点，则将拖入的节点直接追加为子节点
                this.openParentBorn(item, insert, oldParent, moveTo);
            } else {
                //附着的节点是子节点，则把自己变成父节点，并将拖入的节点转成其子节点
                this.childToParentBorn(item, insert, oldParent, moveTo);
            }
        }
        //成为焦点
        insertDom.setAttribute('tabindex', '-1');
        insertDom.focus();
        insertDom.onblur = () => {
            insertDom.removeAttribute('tabindex');
        }
        //监听和回调
        this.options.onDropped && this.options.onDropped.call(this, insert, item);
        'dropped' in this.handlers ? this.emit('dropped', insert, item) : null;
    }
    ulToggle(obj, linkage = true) {
        let wrapper = obj.headerDom,
            arrow = obj.arrowDom,
            legend = obj.legendDom,
            ul = wrapper.nextElementSibling;
        if (obj.expanded == true) {
            //监听回调
            this.options.onCollapse && this.options.onCollapse.call(this, obj);
            'collapse' in this.handlers ? this.emit('collapse', obj) : null;

            //根据expand属性执行slide
            obj.expanded = false;
            wrapper.removeAttribute('expanded');
            //改变指示箭头图标
            if (!this.arrowSame) {
                arrow.classList.remove(this.options.arrowIcon[1]);
                arrow.classList.add(this.options.arrowIcon[0]);
            }
            //改变父节点图标
            if (this.options.iconShow) {
                legend.classList.remove(this.options.parentIcon[1]);
                legend.classList.add(this.options.parentIcon[0]);
            }
            this.eachExapand(obj);
            axSlideUp(ul, '', () => {
                //监听回调
                this.options.onCollapsed && this.options.onCollapsed.call(this, obj);
                'collapsed' in this.handlers ? this.emit('collapsed', obj) : null;
            });

        } else {
            //监听回调
            this.options.onExpand && this.options.onExpand.call(this, obj);
            'expand' in this.handlers ? this.emit('expand', obj) : null;

            obj.expanded = true;
            wrapper.setAttribute('expanded', 'true');
            //改变指示箭头图标
            if (!this.arrowSame) {
                arrow.classList.remove(this.options.arrowIcon[0]);
                arrow.classList.add(this.options.arrowIcon[1]);
            }
            //改变父节点图标
            if (this.options.iconShow) {
                legend.classList.remove(this.options.parentIcon[0]);
                legend.classList.add(this.options.parentIcon[1]);
            }
            this.eachExapand(obj); 
            axSlideDown(ul, '', () => {
                //监听回调
                this.options.onExpanded && this.options.onExpanded.call(this, obj);
                'expanded' in this.handlers ? this.emit('expanded', obj) : null;
            });
            if (linkage) {
                //如果当前节点展开了，那么兄弟节点折叠
                this.siblingsCollapse(this.flatData, obj);
            }

        }
        //保存数据
        this.save();
    };
    selectItem(item, data) {
        if (item.headerDom.hasAttribute('editing') || !this.options.selectable) {
            return false;
        }
        let branches = data.filter(i => i != item);
        if (item.selected == true) {
            item.selected = false;
            this.eachSelect(item);
        } else {
            item.selected = true;
            this.eachSelect(item);
            if (this.options.oneSelected) {
                branches.forEach(i => {
                    if (i.selected == true) {
                        i.selected = false;
                        this.eachSelect(i);
                    }
                });

            }
            //监听回调
            this.options.onSelected && this.options.onSelected.call(this, item);
            'selected' in this.handlers ? this.emit('selected', item) : null;
        }
        //赋值
        this.receiverAssign();
    }
    checkItem(item, data) {
        if (!item.checkDom || item.disabled) {
            return false;
        }
        //超过指定选择数量则返回错误，并是即将选择的时候
        if (this.checkeds.length > this.options.checkMax && !item.checked) {
            console.warn('The length of checked is too much!');
            this.options.onTooMuch && this.options.onTooMuch.call(this, this.checkeds.length, this.options.checkMax);
            'tooMuch' in this.handlers ? this.emit('tooMuch', this.checkeds.length, this.options.checkMax) : null;
            return false;
        }
        if (this.options.checkType == 'checkbox') {
            //如果是复选类型
            if (item.checked == true) {
                item.checked = false;
            } else {
                item.checked = true;
            }
            this.eachCheckbox(item, this.options.linkage);
            //回调
            this.options.onGetCheckeds && this.options.onGetCheckeds.call(this, this.checkeds, item);
        } else if (this.options.checkType == 'radio') {
            //如果是单选类型
            let brothers = data.filter(i => i.pId == item.pId);
            if (brothers.some(i => i.checked == true && i.disabled == true)) {
                //如果同级元素已经有了一个禁止却已经checked的元素则不能操作
                console.warn('You must uncheck the disabled item that have been checked!');
                return false;
            }
            if (this.options.oneRadio && data.some(i => i.checked == true && i.disabled == true)) {
                //如果要求整个tree只允许一个radio，那么只有一个禁止却已经checked的元素则不能操作
                console.warn('You must uncheck the disabled item that have been checked!');
                return false;
            }
            if (item.checked == true) {
                item.checked = false;
            } else {
                item.checked = true;
            }
            this.eachRadio(item, this.options.linkage);
            //回调
            this.options.onGetCheckeds && this.options.onGetCheckeds.call(this, this.checkeds, item);
        }
        //监听回调
        this.options.onChecked && this.options.onChecked.call(this, item, this.checkeds);
        'checked' in this.handlers ? this.emit('checked', item, this.checkeds) : null;
        //赋值
        this.receiverAssign();
    }
    siblingsCollapse(data, item) {
        //如果是toggle模式，其他兄弟节点则折叠
        if (this.options.toggle) {
            let siblings = data.filter(i => i.pId == item.pId && i.children && i != item);
            for (let i of siblings) {
                if (!i.headerDom.nextElementSibling) {
                    //对于sql异步类型，虽然有兄弟节点，但是此时并没有创建ul，所以直接跳过
                    continue;
                } else {
                    i.expanded = true;
                    this.ulToggle(i);
                }
            }
        }
    }
    renderFinish(item, data) {
        let parent = item.headerDom.parentElement;
        //点击指示箭头，ax-none只是做连线
        if (!item.arrowDom.classList.contains(this.options.arrowIcon[2])) {
            item.arrowDom.onclick = () => {
                //如果是sql异步模式，点击先追加子节点
                if (!item.expanded && this.options.async == 'sql') {
                    let ul = item.headerDom.nextElementSibling;
                    //sql异步过来的数据没有通过tree循环生成节点，需要在追加子节点的时候创建ul
                    if (!ul) {
                        ul = axAddElem('ul');
                        item.headerDom.insertAdjacentElement("afterEnd", ul);
                    }
                    if (!ul.querySelector('li')) {
                        //如果没有子节点才异步追加
                        axAjax({
                            //根据参数进行数据扩展
                            data: { pId: item.id },
                            type: this.options.ajaxType,
                            url: this.options.content,
                            opened: (response) => {
                                this.contentXhr = response.xhr;
                            },
                            before: () => {
                                item.arrowDom.setAttribute('loading', '');
                            },
                            success: (response) => {
                                if (axIsEmpty(response.content)) {
                                    console.warn('No data obtained!');
                                    return false;
                                }

                                item.arrowDom.removeAttribute('loading');
                                //先清空
                                ul.innerHTML = '';
                                //反转后依次创建子节点
                                response.content.forEach(i => {
                                    //appendchild方式追加子节点
                                    this.add(i, item, true, false);
                                });
                            }
                        });
                    }


                }
                this.ulToggle(item);
            }
        }

        //初始化selected的项目
        if (this.selected.map(String).includes(item.id.toString())) {
            item.selected = true;
            this.eachSelect(item);
        }

        if (this.options.checkShow) {
            //初始化disabled项目
            if (this.disabled.map(String).includes(item.id.toString())) {
                item.disabled = true;
                //更新禁止的节点数组
                this.eachDisabled(item);
            }
            //初始化checked的项目
            if (this.checked.map(String).includes(item.id.toString())) {
                item.checked = true;
                if (this.options.checkType == 'checkbox') {
                    this.eachCheckbox(item, this.options.linkage);
                } else if (this.options.checkType == 'radio') {
                    this.eachRadio(item, this.options.linkage);
                }
            }
            //点击单选复选
            item.checkDom.onclick = () => {
                this.checkItem(item, data);
            }
            //点击分支行
            if (this.options.clickLineTo === 'check') {
                item.wrapperDom.onclick = (e) => {
                    if ([item.headerDom, item.labelDom, item.indentDom, item.legendDom].includes(e.target)) {
                        this.checkItem(item, data);
                    }
                }
            }
        }

        //定义tools按钮
        if (this.options.toolsShow) {
            //tools操作
            //删除节点
            item.removeDom.onclick = () => {
                if (item.readonly) {
                    return false;
                }
                //
                if (this.options.onBeforeRemove) {
                    let flag = this.options.onBeforeRemove.call(this, item, item.removeDom);
                    if (flag) {
                        this.remove(item);
                    }
                } else {
                    this.remove(item);
                }
            }
            //编辑节点
            item.editDom.onclick = () => {
                if (item.readonly) {
                    return false;
                }
                this.edit(item);
            }
            //增加节点
            item.addDom.onclick = () => {
                if (item.readonly) {
                    return false;
                }
                this.add('', item);
            }
        }

        //点击标题
        if (item.labelDom) {
            //单击高亮
            item.labelDom.onclick = () => {
                //如果已经是编辑状态便取消点击事件，如果不可选择不再执行
                this.selectItem(item, data);
                //打开tools
                if (item.toolsDom && this.options.toolsAction == 'click') {
                    if (item.selected) {
                        item.toolsDom.style.display = 'inline-block';
                    } else {
                        item.toolsDom.style.display = 'none';
                    }
                }

            }
            //双击编辑
            item.labelDom.ondblclick = () => {
                if (item.readonly) {
                    return false;
                }
                this.edit(item);
            }
            //点击分支行
            if (this.options.clickLineTo === 'select') {
                item.wrapperDom.onclick = (e) => {
                    if ([item.headerDom, item.indentDom, item.legendDom].includes(e.target)) {
                        this.selectItem(item, data);
                    }
                }
            }
        }


        /*拖拽节点*/
        //设置LI可拖拽
        if (this.options.draggable == true) {
            //如果直接true则表示整个tree节点都可拖拽
            parent.setAttribute('draggable', 'true');
            parent.addEventListener('dragstart', (e) => {
                //阻止冒泡，只作用于最深的节点
                e.stopPropagation();
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData("id", item.id);
                //this.classList.add('dragElem');
            }, false);
        } else if (axType(this.options.draggable) == 'Array') {
            //如果是数组，则按数组的ID设置可拖拽
            if (this.options.draggable.map(String).includes(item.id.toString())) {
                parent.setAttribute('draggable', 'true');
                parent.addEventListener('dragstart', (e) => {
                    //阻止冒泡，只作用于最深的节点
                    e.stopPropagation();
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData("id", item.id);
                    //this.classList.add('dragElem');
                }, false)
            }
        }
        //进入目标范围
        item.headerDom.addEventListener('dragenter', (e) => {
            e.preventDefault();
        }, false);
        //在目标上移动
        item.headerDom.addEventListener('dragover', (e) => {
            e.preventDefault();
            parent.classList.add('ax-dragging');
            parent.setAttribute('insert', this.dragPlace(e, item.headerDom));
        }, false);
        //离开目标
        item.headerDom.addEventListener('dragleave', (e) => {
            e.preventDefault();
            parent.classList.remove('ax-dragging');
            parent.removeAttribute('insert');
        }, false);
        //放开
        item.headerDom.addEventListener('drop', (e) => {
            e.preventDefault();
            //把拖拽对象放入目标容器中
            let data = e.dataTransfer.getData('id'),
                //此时的data是字符串
                tranItem = this.flatData.filter(i => data == i.id.toString())[0],
                tranParent = this.flatData.filter(i => tranItem.pId == i.id)[0],
                moveDirection;

            if (item.pId == tranItem.pId && item.pId == this.options.rootStart && this.dragPlace(e, item.headerDom) != 'child') {
                //一级之间平移，落子后都没有父层
                moveDirection = '0-0'
            } else if (item.pId == this.options.rootStart && this.dragPlace(e, item.headerDom) != 'child') {
                //二级以下移动到一级(落子后无父层)
                moveDirection = '1-0'
            } else if (tranItem.pId == this.options.rootStart) {
                //一级（拖动前无父层）移动到二级以下
                moveDirection = '0-1'
            } else {
                moveDirection = 'other';
            }
            //释放后取消样式
            parent.classList.remove('ax-dragging');
            parent.removeAttribute('insert');
            //在自身拖放无效
            if (item == tranItem) {
                return false;
            }
            //节点的创建位置
            this.dropItem(item, tranItem, tranParent, this.dragPlace(e, item.headerDom), moveDirection);
        }, false);
        //保存数据
        this.save();
    }
    getParents(idArr, mode = 'obj') {
        let parentsId = [],
            parentsObj = [];
        if (axType(idArr) == 'Array') {
            //如果传入的是ID数组
            let items = this.flatData.filter(i => idArr.map(String).includes(i.id.toString()));
            items.forEach(i => {
                let paths = i.path.split('>').filter(k => k.id != this.options.rootStart && k != i.id);
                parentsId.push(...paths);
            });
        } else if (axType(idArr) == 'Object') {
            //如果是一个{}对象
            let paths = idArr.path.split('>').filter(k => k.id != this.options.rootStart && k != idArr.id);
            parentsId.push(...paths);
        } else {
            //如果仅仅是一个ID
            let item = this.flatData.filter(i => i.id == idArr)[0],
                paths = item.path.split('>').filter(k => k.id != this.options.rootStart && k != item.id);
            parentsId.push(...paths);
        }
        //path中的父节点id可能有重复的，所以去重
        parentsId = [...new Set(parentsId)];
        parentsObj = this.flatData.filter(i => parentsId.includes(i.id.toString()));
        if (mode == 'obj') {
            return parentsObj;
        } else if (mode == 'id') {
            return parentsId;
        } else {
            return { obj: parentsObj, id: parentsId }
        }
    }
    getChildren(idArr) {
        let childrenObj = [];
        if (axType(idArr) == 'Array') {
            //如果传入的是ID数组
            idArr.forEach(i => {
                let children = this.flatData.filter(k => k.path.includes('>' + i + '>'));
                childrenObj.push(...children);
            });
        } else if (axType(idArr) == 'Object') {
            //如果是一个{}对象
            childrenObj = this.flatData.filter(k => k.path.includes('>' + idArr.id + '>'));
        } else {
            //如果仅仅是一个ID
            childrenObj = this.flatData.filter(k => k.path.includes('>' + idArr + '>'));
        }
        return childrenObj;
    }
    eachSelect(item) {
        if (item.selected == true) {
            item.headerDom.setAttribute('selected', 'true');
            //将该id追加进this.selecteds
            !this.selecteds.includes(item) ? this.selecteds.push(item) : null;
        } else {
            item.headerDom.removeAttribute('selected');
            //从this.selecteds删除
            for (let i = 0; i < this.selecteds.length; i++) {
                if (this.selecteds[i] == item) {
                    this.selecteds.splice(i, 1);
                    break;
                }
            }
        }
    }
    eachDisabled(item) {
        //checkbox专用，父checked等于所有子checked
        let flagToggle = (k, flag) => {
            if (flag) {
                k.headerDom.setAttribute('disabled', 'true');
                //将该id追加进this.disableds
                !this.disableds.includes(k) ? this.disableds.push(k) : null;
            } else {
                k.headerDom.removeAttribute('disabled');
                //从this.disableds删除
                for (let i = 0; i < this.disableds.length; i++) {
                    if (this.disableds[i] == k) {
                        this.disableds.splice(i, 1);
                        break;
                    }
                }
            }
        }
        let childChecked = (k, flag) => {
            //向下循环，设置disabled属性并修改节点
            k.disabled = flag;
            flagToggle(k, flag);
            if (k.children && k.children.length > 0) {
                let children = [...k.children].filter(i => !i.disabled);
                children.forEach(i => {
                    childChecked(i, flag);
                });
            }
        }

        if (item.disabled == true) {
            flagToggle(item, true);
            //如果是复选，父禁用了，那么子都禁用
            if (this.options.checkType == 'checkbox') {
                childChecked(item, true);
            }
        } else {
            flagToggle(item, false);
            //如果是复选，父不禁用了，那么子都不禁用
            if (this.options.checkType == 'checkbox') {
                childChecked(item, false);
            }
        }
    }
    eachExapand(item) {
        if (item.expanded == true) {
            item.headerDom.setAttribute('expanded', 'true');
            //将该id追加进this.expandeds
            !this.expandeds.includes(item) ? this.expandeds.push(item) : null;
        } else {
            item.headerDom.removeAttribute('expanded');
            //从this.expandeds删除
            for (let i = 0; i < this.expandeds.length; i++) {
                if (this.expandeds[i] == item) {
                    this.expandeds.splice(i, 1);
                    break;
                }
            }
        }
    }
    checkToggle(obj, flag, type) {
        //根据checked值来判断icon
        let itemDom = obj.headerDom,
            checkDom = itemDom.querySelector('[check]'),
            icon = type == 'checkbox' ? 'checkboxIcon' : type == 'radio' ? 'radioIcon' : '';
        if (flag == true) {
            obj.checked = true;
            itemDom.setAttribute('checked', 'true');
            checkDom.classList.remove(this.options[icon][0], this.options[icon][1]);
            checkDom.classList.add(this.options[icon][2]);
        } else if (flag == false) {
            obj.checked = false;
            itemDom.setAttribute('checked', 'false');
            checkDom.classList.remove(this.options[icon][1], this.options[icon][2]);
            checkDom.classList.add(this.options[icon][0]);
        } else if (flag == 'ing') {
            obj.checked = 'ing';
            itemDom.setAttribute('checked', 'ing');
            checkDom.classList.remove(this.options[icon][0], this.options[icon][2]);
            checkDom.classList.add(this.options[icon][1]);
        }
    }
    eachCheckbox(item, linkage) {
        //通过触发已经修改了obj的checked属性，据此执行如下操作
        if (linkage) {
            //如果是整个tree的父子联动
            let floatDown = (obj) => {
                let isParent = obj.children;
                //往下循环
                if (isParent) {
                    if (obj.checked == true) {
                        //已选择状态
                        this.checkToggle(obj, true, 'checkbox');
                        //子元素循环
                        obj.children.forEach(i => {
                            if (!i.disabled) {
                                //非禁用才可勾选
                                i.checked = true;
                                floatDown(i);
                            }
                        })
                    } else if (!obj.checked) {
                        //未选状态
                        this.checkToggle(obj, false, 'checkbox');
                        //子元素循环
                        obj.children.forEach(i => {
                            if (!i.disabled) {
                                //非禁用才可取消勾选
                                i.checked = false;
                                floatDown(i);
                            }
                        })
                    }
                } else {
                    if (obj.checked == true) {
                        //已选择状态
                        this.checkToggle(obj, true, 'checkbox');
                    } else if (!obj.checked) {
                        //未选状态
                        this.checkToggle(obj, false, 'checkbox');
                    }
                }
            },
                floatUp = (obj) => {
                    //往上循环
                    let parentArr = obj.path.split('>').filter(i => i !== this.options.rootStart && i != obj.id),
                        //parentArr的数组是字符串，所以需要对id使用toString()方法，reverse表示从最近父节点往最远父节点遍历
                        parents = this.flatData.filter(i => parentArr.includes(i.id.toString())).reverse();
                    parents.forEach(i => {
                        if (i.children.filter(k => !k.disabled).every(k => !k.checked)) {
                            //非disabled节点全部为false
                            this.checkToggle(i, false, 'checkbox');
                        } else if (i.children.filter(k => !k.disabled).every(k => k.checked == true)) {
                            //非disabled节点全部为true
                            this.checkToggle(i, true, 'checkbox');

                        } else if (i.children.some(k => k.checked == true || k.checked == 'ing')) {
                            //至少有一项为为true或ing
                            this.checkToggle(i, 'ing', 'checkbox');
                        }
                    });
                };
            //向下遍历子节点
            floatDown(item);
            //向上遍历父节点
            floatUp(item);
        } else {
            //如果父子不联动，只是本节点true和false切换
            if (item.checked == true) {
                this.checkToggle(item, true, 'checkbox');
            } else if (!item.checked) {
                this.checkToggle(item, false, 'checkbox');
            } else {
                this.checkToggle(item, 'ing', 'checkbox');
            }
        }
        //更新checkeds
        //先清空
        this.checkeds = [];
        let checkedItems = this.flatData.filter(i => i.checked == true);
        checkedItems.forEach(i => {
            this.checkeds.push(i);
        });
        //超过限制则返回错误
        if (this.checkeds.length > this.options.checkMax) {
            console.warn('The length of checked is too much!');
            this.options.onTooMuch && this.options.onTooMuch.call(this, this.checkeds.length, this.options.checkMax);
            'tooMuch' in this.handlers ? this.emit('tooMuch', this.checkeds.length, this.options.checkMax) : null;
        } else if (this.checkeds.length < this.options.checkMin) {
            console.warn('The length of checked is too little!');
            this.options.onTooLittle && this.options.onTooLittle.call(this, this.checkeds.length, this.options.checkMin);
            'tooLittle' in this.handlers ? this.emit('tooLittle', this.checkeds.length, this.options.checkMin) : null;
        }
    }
    eachRadio(item, linkage) {
        //通过触发已经修改了obj的checked属性，据此执行如下操作
        //本节点true和false切换，其他兄弟节点相反
        if (item.checked == true) {
            //同级别的已经radio元素取消checked
            let hasRadio = [];
            if (this.options.oneRadio) {
                //整个树只能有一个radio=checked
                hasRadio = this.flatData.filter(i => i.checked == true && i != item);
            } else {
                hasRadio = this.flatData.filter(i => i.pId == item.pId && i.checked == true && i != item);
            };
            hasRadio.forEach(i => {
                this.checkToggle(i, false, 'radio');
            });

            this.checkToggle(item, true, 'radio');
        } else {
            this.checkToggle(item, false, 'radio');
        }
        if (linkage) {
            //如果是整个tree的父子联动
            let traverse = () => {
                //根据已经checked的元素，算出来他们的所有父节点的id
                //如果某个checked元素正好又是父节点，那么应该将其排除在外
                let checkeds = this.flatData.filter(i => i.checked == true),
                    parentArr = [];
                checkeds.forEach(i => {
                    let paths = i.path.split('>').filter(k => k !== this.options.rootStart && k != i.id);
                    parentArr.push(...paths);
                });
                //path中的父节点id可能有重复的，所以去重
                parentArr = [...new Set(parentArr)];
                //parentArr数组的项是字符串["2","8"]，所以需要使用toString方法
                let ingParents = this.flatData.filter(i => parentArr.includes(i.id.toString())),
                    //i != item是指将点击的父节点排除在外,!i.checked是指已经checked的排除在外
                    allParents = this.flatData.filter(i => i.children && i != item && !i.checked);

                //先清理掉checked=ing的父节点
                allParents.forEach(i => {
                    if (i.checked) {
                        //只需要对checked=ing或true的父节点取消checked
                        this.checkToggle(i, false, 'radio');
                    }
                });

                if (!axIsEmpty(ingParents)) {
                    ingParents.forEach(i => {
                        if (i.checked == true) {
                            //ingParents中的节点也是是可以checked的
                            this.checkToggle(i, true, 'radio');
                        } else {
                            this.checkToggle(i, 'ing', 'radio');
                        }

                    });
                }
            };
            //遍历父节点
            traverse();
        }
        //更新checkeds
        //先清空
        this.checkeds = [];
        let checkedItems = this.flatData.filter(i => i.checked == true);
        checkedItems.forEach(i => {
            this.checkeds.push(i);
        });
    }
    arrange(data) {
        //将数组穷尽为多个length为2的子数组，以便于两两比较
        let newArr = [];
        data.forEach((item, index) => {
            let rest = data.slice(index + 1, data.length);
            rest.forEach(i => {
                let itemArr = [];
                itemArr = [item, i];
                newArr.push(itemArr);
            })
        });
        return newArr;
    }
    fixChecked(data) {
        //1、checked的项多余要求的数量
        //2、checked的项少于最少数量
        //3、radio类型，同一层级只能填一个id，否则报错
        let flag = true;
        if (this.options.checked.length > this.checkMax) {
            //如果允许最大check数量小于设定的check长度，则自动截取
            console.warn('The length of checked has been automatically intercepted!');
            this.options.onTooMuch && this.options.onTooMuch.call(this, this.options.checked.length, this.checkMax);
            'tooMuch' in this.handlers ? this.emit('tooMuch', this.options.checked.length, this.checkMax) : null;
            this.checked = this.options.checked.splice(this.checkMax)
        } else {
            this.checked = this.options.checked;
        }
        if (this.checked.length < this.checkMin) {
            //如果允许最少check数量大于设定的check长度，则返回false
            console.error('The length of checked has exceeded the limit!');
            this.options.onTooLittle && this.options.onTooLittle.call(this, this.checked.length, this.checkMin);
            'tooLittle' in this.handlers ? this.emit('tooLittle', this.checked.length, this.checkMin) : null;
            flag = false;
        }
        if (this.options.checkType == 'radio' && this.checked.length > 1) {
            //对于radio类型，check节点只要有两个是相同的层级，则返回false（对于单选，同一层级只能单选一个）
            flag = !this.arrange(this.checked).some(item => {
                return data.find(i => i.id == item[0]).pId == data.find(i => i.id == item[1]).pId
            });
            if (!flag) {
                console.error('Only one item can be selected at the same level!');
            }
        } else if (this.options.checkType == 'checkbox') {

        }
        return flag;
    }
    fixExpand(data) {
        //1、修正expand的展开项
        //2、根据radio和checkbox对父层使用checking属性
        let newArr = []
        data.forEach(item => {
            let arr = item.path.split('>').filter(i => i != this.options.rootStart);
            //path的最后一项包含在expand项内才push
            if (this.options.expanded.map(String).includes(arr[arr.length - 1])) {
                newArr.push(...arr);
            }
            //给父层追加checking或checked
            if (item.children && item.children.length > 0) {
                let childObj = [];
                item.children.forEach(i => {
                    childObj.push(i.id);
                });

                //父子联动
                if (this.options.linkage) {
                    if (childObj.every(k => this.checked.map(String).includes(k.toString()))) {
                        //如果完全包含，使用checked
                        item.checked = true;
                    } else if (childObj.some(k => this.checked.map(String).includes(k.toString()))) {
                        //只要包含一个，使用checking
                        item.checked = 'ing';
                    }
                }

            }
        });
        //去重
        this.expanded = [...new Set(newArr)];
        //添加属性
        this.expanded.forEach(item => {
            //有children节点才追加expand属性
            let find = data.find(i => item == i.id && i.children);
            find ? find.expanded = true : null;
        });
    }
    createItem(obj, floor) {
        let check = '',
            tools = `<span tools><i class="ax-iconfont ax-icon-plus" add></i><i class="ax-iconfont ax-icon-edit" edit></i><i class="ax-iconfont ax-icon-trash" remove></i></span>`;
        //根据options参数和obj的checked参数预先确定check字符串
        if (this.options.checkType == 'checkbox' && this.options.checkShow) {
            if (obj.hasOwnProperty('checked')) {
                if (obj.checked == true) {
                    check = this.checkIcon.checkbox[2];
                } else if (obj.checked == 'ing') {
                    check = this.checkIcon.checkbox[1];
                }
            } else {
                check = this.checkIcon.checkbox[0];
            }
        } else if (this.options.checkType == 'radio' && this.options.checkShow) {
            if (obj.hasOwnProperty('checked')) {
                if (obj.checked == true) {
                    check = this.checkIcon.radio[2];
                } else if (obj.checked == 'ing') {
                    check = this.checkIcon.radio[1];
                }
            } else {
                check = this.checkIcon.radio[0];
            }
        }

        //创建<div></div>节点
        let arrow = `<i class="${!this.arrowSame ? 'ax-different' : ''} ax-iconfont ${obj.children ? this.options.arrowIcon[0] : this.options.arrowIcon[2]}" arrow></i>`,
            nodeTpl = `
                        <div class="ax-node" >
                            <span indent>${'<i></i>'.repeat(floor - 1)}</span>
                            ${arrow}
                            ${check}
                            <# if(this.children){ #>${this.fileIcon ? this.fileIcon.parent : ''}<# } else { #>${this.fileIcon ? this.fileIcon.child : ''} <# } #>
                            <i label><# this.label #></i>
                            ${this.options.toolsShow ? tools : ''}
                        </div>`;
        //写上第一组dom节点
        obj.headerDom = axStrToDom(axTplEngine(nodeTpl, obj));
        obj.toolsDom = obj.headerDom.querySelector('[tools]');
        obj.indentDom = obj.headerDom.querySelector('[indent]');
        obj.arrowDom = obj.headerDom.querySelector('[arrow]');
        obj.labelDom = obj.headerDom.querySelector('[label]');
        obj.legendDom = obj.headerDom.querySelector('[legend]');
        obj.checkDom = obj.headerDom.querySelector('[check]');
        obj.otherTools = [];
        //如果有其他的操作方式则在ax-tools中追加上
        if (!axIsEmpty(this.options.addTools)) {
            this.options.addTools.forEach(i => {
                //获得工具对象并加入到otherTools
                let toolObj = { dom: axStrToDom(i.dom), callback: i.callback };
                obj.otherTools.push(toolObj);
                //
                toolObj.dom.onclick = () => {
                    toolObj.callback.call(this, obj);
                }
                obj.toolsDom.insertAdjacentElement('afterBegin', toolObj.dom);
            })
        }
        //将tools写在obj的dom属性上
        obj.addDom = obj.headerDom.querySelector('[add]');
        obj.editDom = obj.headerDom.querySelector('[edit]');
        obj.removeDom = obj.headerDom.querySelector('[remove]');
        //回调
        obj.callback && obj.callback.call(this, obj);
        //生成dom节点
        return obj.headerDom;
    }
    addAttritue(obj, div) {
        //写上id
        div.setAttribute('mark', obj.id);

        //设置只读属性，不可增删改操作
        if (this.options.readonly.map(String).includes(obj.id.toString())) {
            this.readonly(obj);
        }
        //设置expand属性，更新this.expandeds
        //checked，selected和disabled已经在创建树节点前已经设置了
        this.eachExapand(obj);
        //设置显示tools的方式
        this.options.toolsShow ? div.setAttribute('toolsAction', this.options.toolsAction) : null;
    }
    refreshTree(data) {
        //根据源数据更新一维数组,基础上添加了checked、selected、disabled、pId、path、floor属性返回this.flatData
        //更新floorMax，axTreeMethod.addPath将处理treeData返回floorMax
        this.floorMax = axTreeMethod.addPath(data, this.options.rootStart).floorMax;
        //将tree数据拍平，转成带parent属性的数组：[{id:1,label:''},{id:2,label:'',parent:1}...]
        this.flatData = axArrToFlat(this.treeData);
        //返回更新后的this.treeData
        return data;
    }
    arrayToDom(data) {
        let outer = axAddElem('ul'),
            fragment = document.createDocumentFragment();
        //obj = { id: '', label: '',  checked: '', selected: '', expanded: '', disabled: '',floor:2 ,children: ''}
        let plantTree = (parent, data) => {
            let ul = axAddElem('ul');
            data.forEach(item => {
                item.headerDom = this.createItem(item, item.floor);
                item.wrapperDom = axAddElem('li');
                //设置基本属性
                this.addAttritue(item, item.headerDom);
                //div加入到li中
                item.wrapperDom.appendChild(item.headerDom);
                if (item.hasOwnProperty('children')) {
                    plantTree(item.wrapperDom, item.children);
                }
                ul.appendChild(item.wrapperDom);
            });
            //最外围的UL写入fragment
            parent.appendChild(ul);
            return parent;
        }
        plantTree(outer, data);
        //不要ul外标签，只取一级li标签
        let list = outer.childNodes[0].childNodes;
        [...list].forEach(item => {
            fragment.appendChild(item);
        });
        //最终生成页面节点
        this.targetDom.appendChild(fragment);

        //根据expand属性，展开ul节点
        let expandDivs = this.targetDom.querySelectorAll('[expanded]');
        [...expandDivs].forEach(item => {
            item.nextElementSibling.style.display = 'block';
        });
        //监听回调
        this.options.onPlanted && this.options.onPlanted.call(this);
        'planted' in this.handlers ? this.emit('planted', '') : null;
    }
    getItemsFromPath(source, connector = this.options.output.connector, prop = this.options.output.prop) {
        let arr = source.split('>'),
            items = arr.map(k => this.flatData.find(i => i.id == k)).filter(Boolean),
            path = items.map(k => k[prop]).join(connector);
        return { items, path };
    }
    receiverAssign() {
        //输出值
        if (this.receiver) {
            if (this.receiver.nodeName === 'INPUT' || this.receiver.nodeName === 'TEXTAREA') {
                this.receiver.value = this.getValues();
            } else {
                this.receiver.innerHTML = this.getValues();
            }
        }
    }
    getValues(options = {}) {
        let type = options.type || this.options.output.type,
            connector = options.connector || this.options.output.connector,
            separator = options.separator || this.options.output.separator,
            prop = options.prop || this.options.output.prop,
            isStr = options.isString || true,
            from = options.from || this.options.output.from,
            items = from === 'checked' ? this.checkeds : this.selecteds,
            resultArr = [];

        if (type === 'ultimate') {
            //只需终极子项
            resultArr = items.filter(k => !k.children).map(k => {
                return k[prop];
            });
        } else if (type === 'parent') {
            resultArr = items.filter(k => k.children).map(k => {
                return k[prop];
            });
        } else if (type === 'chain') {
            resultArr = items.map(k => {
                return axTreeMethod.getItemsFromPath({ path: k.path, data: this.flatData, connector, prop }).path;
            });
        } else {
            resultArr = items.map(k => {
                return k[prop];
            });
        }
        //输出
        return isStr ? resultArr.join(separator) : resultArr;
    }
    add(newItem, target, isChild = true, isFront = true, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        //isChild=true是指添加子节点，false是指添加兄弟节点
        //target可以是{}也可以是id，如果为空则找到第一级的最后一个节点
        let targetItem;
        if (!target && target !== 0) {
            targetItem = this.flatData.filter(k => k.floor === 1).slice(-1)[0];
            isChild = false;
            isFront = false;
        } else {
            targetItem = axFindItem(target, this.flatData);
        }
        let itemDom = targetItem.headerDom,
            obj = {};
        if (!axIsEmpty(newItem) && typeof newItem == 'object') {
            //直接传入要新增的节点对象（从sql）
            let other = isChild ? {
                path: targetItem.path + '>' + newItem.id,
                floor: targetItem.floor + 1
            } : {
                path: targetItem.path.replace(new RegExp('(.*)' + targetItem.id), '$1' + newItem.id),
                floor: targetItem.floor
            };
            obj = Object.assign(newItem, other);
        } else {
            //从物理节点获得数据会自动创建id，maxIndex会自动递增
            let newId = axIncreaseId(this.flatData),
                newName = newItem && typeof newItem === 'string' ? newItem : '新节点' + newId;
            //点击新增按钮新增节点
            obj = isChild ? {
                id: newId,
                label: newName,
                pId: targetItem.id,
                path: targetItem.path + '>' + newId,
                floor: targetItem.floor + 1
            } : {
                id: newId,
                label: newName,
                pId: targetItem.pId,
                path: targetItem.path.replace(new RegExp('(.*)' + targetItem.id), '$1' + newId),
                floor: targetItem.floor
            };
        }

        //根据obj创建div和li节点并赋予objdom属性
        obj.headerDom = this.createItem(obj, obj.floor);
        obj.wrapperDom = axAddElem('li');
        this.addAttritue(obj, obj.headerDom);
        obj.wrapperDom.appendChild(obj.headerDom);

        if (isChild) {
            //类型是添加子节点，child
            if (targetItem.children) {
                //在父节点操作，给父节点children增加数组项，Dom树增加分支
                isFront ? targetItem.children.unshift(obj) : targetItem.children.push(obj);
                let ul = itemDom.nextElementSibling;

                ul.insertAdjacentElement(isFront ? "afterBegin" : "beforeEnd", obj.wrapperDom);
                //修改this.flatData
                this.flatData.push(obj);
                //展开本节点，如果已经展开了就不需要执行了
                if (!targetItem.expanded) {
                    this.ulToggle(targetItem);
                }
            } else {
                //在子节点操作，让子节点变成父节点并增加子项，Dom树增加分支
                targetItem.children = [];
                isFront ? targetItem.children.unshift(obj) : targetItem.children.push(obj);
                //增加指示箭头并展开

                let arrow = itemDom.querySelector('[arrow]'),
                    ul = axAddElem('ul', { style: 'display:block' });
                arrow.classList.remove(this.options.arrowIcon[2]);
                arrow.classList.add(this.options.arrowIcon[0]);
                targetItem.expanded = true;
                itemDom.setAttribute('expanded', 'true');
                ul.insertAdjacentElement(isFront ? "afterBegin" : "beforeEnd", obj.wrapperDom);
                itemDom.insertAdjacentElement("afterEnd", ul);
                //修改this.flatData
                this.flatData.push(obj);
                //如果是toggle模式，其他兄弟节点则折叠
                this.siblingsCollapse(this.flatData, targetItem);
                //让指示箭头功能生效
                arrow.onclick = () => {
                    this.ulToggle(targetItem);
                }
            }
        } else {
            //类型是添加兄弟节点，brother
            let parent = this.flatData.filter(i => i.id == targetItem.pId)[0],
                //顶级节点没有父节点了，所以children直接等于flatData
                children = parent ? parent.children : this.treeData,
                index = children.indexOf(targetItem);
            //插入
            if (isFront) {
                //如果是第一项则直接头部追加
                index == 0 ? children.unshift(obj) : children.splice(index, 0, obj);
            } else {
                children.splice(index + 1, 0, obj);
            }

            itemDom.parentElement.insertAdjacentElement(isFront ? "beforeBegin" : "afterEnd", obj.wrapperDom);
            //修改this.flatData
            this.flatData.push(obj);
            //如果是用js追加节点，可以让父节点展开（顶级没有父节点便不用展开）
            if (parent && !parent.expanded) {
                parent.expanded = true;
                this.ulToggle(parent);
            }
        }

        //让新节点可操作
        this.renderFinish(obj, this.flatData);
        //成为焦点
        obj.headerDom.setAttribute('tabindex', '-1');
        obj.headerDom.focus();
        obj.headerDom.onblur = () => {
            obj.headerDom.removeAttribute('tabindex');
        }
        //监听回调
        this.options.onAdded && this.options.onAdded.call(this, obj, targetItem);
        'added' in this.handlers ? this.emit('added', obj, targetItem) : null;
        callback && callback.call(this, obj, targetItem);
        //保存数据
        this.save();
        return this;
    }
    edit(itemObj, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        //itemObj可以是{}也可以是id
        let item = axFindItem(itemObj, this.flatData),
            itemDom = item.headerDom,
            nameDom = itemDom.querySelector('[label]'),
            editInput = axAddElem('input', { type: 'text' });
        if (itemDom.hasAttribute('editing')) {
            return false;
        }
        itemDom.setAttribute('editing', 'true');
        nameDom.innerHTML = '';
        nameDom.appendChild(editInput);
        //先聚焦再赋值可确保光标在input的文字之后
        editInput.focus();
        editInput.value = item.label;

        //失焦等于完成编辑
        editInput.onblur = () => {
            let value = editInput.value;
            itemDom.removeAttribute('editing');
            item.label = value;
            nameDom.innerHTML = value;
            //监听回调
            this.options.onEdited && this.options.onEdited.call(this, item);
            'edited' in this.handlers ? this.emit('edited', item) : null;
        }
        //使用回车等于onblur
        editInput.onkeyup = (e) => {
            if (e.keyCode == 13) {
                editInput.blur();
            }
        }
        //监听回调
        this.options.onEditing && this.options.onEditing.call(this, item);
        'editing' in this.handlers ? this.emit('editing', item) : null;
        callback && callback.call(this, item);
        //保存数据
        this.save();
        return this;
    }
    remove(itemObj, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        //itemObj可以是{}也可以是id
        let item = axFindItem(itemObj, this.flatData),
            itemLi = item.headerDom.parentElement;
        //清除tree上的节点
        itemLi.remove();
        //从父元素中删除自己
        if (item.pId && item.pId != this.options.rootStart) {
            //一级父元素没有pId或者pId=0，所以本操作只针对二级父元素以下
            let parent = this.flatData.filter(i => i.id == item.pId)[0],
                children = parent.children,
                index = children.indexOf(item);
            children.splice(index, 1);
        } else {
            this.treeData = this.treeData.filter(i => i != item);
        }
        //删除自身对象以及子对象
        this.flatData = this.flatData.filter(i => i != item && !i.path.includes('>' + item.id + '>'));
        //监听回调
        this.options.onRemoved && this.options.onRemoved.call(this, item);
        'removed' in this.handlers ? this.emit('removed', item) : null;
        callback && callback.call(this, item);
        //保存数据
        this.save();
        return this;
    }
    search(value, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        //先从以前的检索项恢复
        if (this.searchs.length > 0) {
            //name恢复原始文字
            this.searchs.forEach(i => {
                i.headerDom.querySelector('[label]').innerHTML = i.label;
            });
            //之前隐藏的li先显示
            let other = this.treeData.filter(i => i.headerDom.parentElement.style.display == 'none');
            other.forEach(i => {
                i.headerDom.parentElement.removeAttribute('style');
            });
        }
        //为空就不需要继续执行了
        if (!value) {
            //清空
            this.searchs = [];
            //取消none状态
            this.flatData.forEach(i => {
                let k = i.headerDom.parentElement;
                if (k.style.display == 'none') {
                    k.removeAttribute('style');
                }
            });
        } else {
            let ids = [];
            this.searchs = this.flatData.filter(i => i.label.includes(value));
            //创建ids数组
            this.searchs.forEach(i => {
                ids.push(i.id);
                //关键字高亮
                let text = i.labelDom.innerHTML.replace(value, '<i>' + value + '</i>');
                i.labelDom.innerHTML = text;
            });
            //所有上级父节点均展开
            let parents = this.getParents(ids, 'both'), allIds = [];

            parents.obj.forEach(i => {
                i.expanded = true;
                i.headerDom.setAttribute('expanded', 'true');
                i.headerDom.nextElementSibling.style.display = 'block';
            });
            //父节点和检索到的节点id合并
            allIds = [...parents.id, ...ids].map(String);
            //数组每一项转字符串类型
            parents.id.map(String);

            //从id和pId获得需要隐藏的项
            let otherParents = this.flatData.filter(k => parents.id.includes(k.pId.toString()) && !allIds.includes(k.id.toString()));

            //检索项和其父节点显示
            this.flatData.filter(i => !otherParents.includes(i)).forEach(i => {
                i.headerDom.parentElement.removeAttribute('style');
            });
            //其他节点隐藏
            for (let i of otherParents) {
                if (i.headerDom.parentElement.style.display == 'none') {
                    //otherParents中可能有重复项，对于重复项已经写入了style，所有直接跳过了
                    continue;
                } else {
                    i.headerDom.parentElement.style.display = 'none';
                }
            }
        }
        //监听回调
        this.options.onSearched && this.options.onSearched.call(this, this.searchs, value);
        'searched' in this.handlers ? this.emit('searched', this.searchs, value) : null;
        callback && callback.call(this, this.searchs, value);
        //保存数据
        this.save();
        return this;
    }
    check(idArr, flag = true, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let items;
        if (axType(idArr) == 'Array') {
            //如果传入的是ID数组
            items = this.flatData.filter(i => idArr.map(String).includes(i.id.toString()));
            for (let i of items) {
                if (i.checked == flag) {
                    //当前的checked值与传入的flag值一致就跳出本次循环
                    continue;
                } else {
                    i.checked = flag;
                    if (this.options.checkType == 'checkbox') {
                        this.eachCheckbox(i, this.options.linkage);
                    } else if (this.options.checkType == 'radio') {
                        this.eachRadio(i, this.options.linkage);
                    }
                }
            }
        } else {
            //如果是一个ID
            items = this.flatData.filter(i => i.id == idArr);
            if (items.checked == flag) {
                //当前的checked值与传入的flag值一致就跳出本次循环
                return false;
            } else {
                items[0].checked = flag;
                if (this.options.checkType == 'checkbox') {
                    this.eachCheckbox(items[0], this.options.linkage);
                } else if (this.options.checkType == 'radio') {
                    this.eachRadio(items[0], this.options.linkage);
                }
            }
        }
        //return items;
        this.options.onSetChecked && this.options.onSetChecked.call(this, items);
        'setChecked' in this.handlers ? this.emit('setChecked', items) : null;
        callback && callback.call(this, items);
        //保存数据
        this.save();
        return this;
    }
    disable(idArr, flag = true, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let items;
        if (axType(idArr) == 'Array') {
            //如果传入的是ID数组
            items = this.flatData.filter(i => idArr.map(String).includes(i.id.toString()));
            let children = [];
            items.forEach(i => {
                children.push(...this.getChildren(i));
            });
            //去重
            children = [...new Set(children)];
            items.push(...children);
            for (let i of items) {
                if (i.disabled == flag) {
                    //当前的checked值与传入的flag值一致就跳出本次循环
                    continue;
                } else {
                    i.disabled = flag;
                    //更新禁止的节点数组
                    this.eachDisabled(i);
                    children.forEach(k => {
                        k.disabled = flag;
                        this.eachDisabled(k);
                    });
                }
            }
        } else {
            //如果是一个ID
            if (items.disabled == flag) {
                //当前的checked值与传入的flag值一致就跳出本次循环
                return false;
            } else {
                items = this.flatData.filter(i => i.id == idArr);
                this.getChildren(items[0]).forEach(i => {
                    i.disabled = flag;
                    this.eachDisabled(i);
                });

            }
        }
        items.forEach(i => {
            //可点击checked操作
            i.disabled = flag;
            i.checkDom.onclick = () => {
                this.checkItem(i, this.flatData);
            }
        });
        //return items;
        this.options.onSetDisabled && this.options.onSetDisabled.call(this, items);
        'setDisabled' in this.handlers ? this.emit('setDisabled', items) : null;
        callback && callback.call(this, items);
        //保存数据
        this.save();
        return this;

    }
    readonly(idArr, flag = true, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let fun = (item, flag) => {
            if (flag) {
                item.readonly = true;
                item.headerDom.setAttribute('readonly', 'true');
            } else {
                item.readonly = false;
                item.headerDom.removeAttribute('readonly');
            }
        },
            items = [];
        if (axType(idArr) == 'Array') {
            //如果是一个ID数组
            items = this.flatData.filter(i => idArr.map(String).includes(i.id.toString()));
            items.forEach(i => {
                fun(i, flag);
            })
        } else if (axType(idArr) == 'Object') {
            //如果是一个{}对象
            fun(idArr, flag);
            items.push(idArr);
        } else {
            //如果是一个ID
            let item = this.flatData.filter(i => i.id == idArr)[0];
            fun(item, flag);
            items.push(item);
        }
        //以之前的readonly项为基础添加进新的
        this.readonlys = [...this.readonlys, ...items];
        //去重
        this.readonlys = [...new Set(this.readonlys)];
        //return items;
        this.options.onSetReadonly && this.options.onSetReadonly.call(this, items);
        'setReadonly' in this.handlers ? this.emit('setReadonly', items) : null;
        callback && callback.call(this, items);
        //保存数据
        this.save();
        return this;
    }
    expand(idArr, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let expands = []
        if (axType(idArr) == 'Array') {
            expands = this.flatData.filter(i => !i.expanded && i.children && idArr.map(String).includes(i.id.toString()));
        } else {
            expands = this.flatData.filter(i => !i.expanded && i.children && idArr == i.id);
        }
        expands.forEach(i => {
            //先设为false，节点再展开
            i.expanded = false;
            this.ulToggle(i, false);
        });
        //更新
        this.expandeds = this.flatData.filter(i => i.expanded && i.children);
        //监听回调
        callback && callback.call(this, expands);
        return this;
    }
    expandAll(callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let expands = this.flatData.filter(i => !i.expanded && i.children);
        expands.forEach(i => {
            //先设为false，节点再展开
            i.expanded = false;
            this.ulToggle(i, false);
        });
        //更新
        this.expandeds = expands;
        //监听回调
        this.options.onExpandAll && this.options.onExpandAll.call(this);
        'expandAll' in this.handlers ? this.emit('expandAll', '') : null;
        callback && callback.call(this);
        return this;
    }
    collapse(idArr, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let collapses = []
        if (axType(idArr) == 'Array') {
            collapses = this.flatData.filter(i => i.expanded && i.children && idArr.map(String).includes(i.id.toString()));
        } else {
            collapses = this.flatData.filter(i => i.expanded && i.children && idArr == i.id);
        }
        collapses.forEach(i => {
            //先设为true，节点再折叠
            i.expanded = true;
            this.ulToggle(i, false);
        });
        //更新
        this.expandeds = this.flatData.filter(i => i.expanded && i.children);
        //监听回调
        callback && callback.call(this, collapses);
        return this;
    }
    collapseAll(callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let collapses = this.flatData.filter(i => i.expanded && i.children);
        collapses.forEach(i => {
            //先设为true，节点再折叠
            i.expanded = true;
            this.ulToggle(i, false);
        });
        //更新
        this.expandeds = [];
        //监听回调
        this.options.onCollapseAll && this.options.onCollapseAll.call(this);
        'collapseAll' in this.handlers ? this.emit('collapseAll', '') : null;
        callback && callback.call(this);
        return this;
    }
    reset(callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        this.targetDom.innerHTML = this.rawHTML ? this.rawHTML : '';
        this.init();
        this.options.onReset && this.options.onReset.call(this);
        'reset' in this.handlers ? this.emit('reset', '') : null;
        callback && callback.call(this);
        return this;
    }
    updateContent(target, source, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        let targetItem = axFindItem(target, this.flatData);
        if (targetItem && typeof source === 'string') {
            targetItem.label = source;
            targetItem.labelDom.innerHTML = source;
            //监听回调
            this.options.onUpdateContent && this.options.onUpdateContent.call(this, targetItem);
            'updateContent' in this.handlers ? this.emit('updateContent', targetItem) : null;
            callback && callback.call(this, targetItem);
            return this;
        }
    }
    update(setting, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        this.options = axExtend(this.options, setting);
        //删除缓存
        this.options.storageName ? axLocalStorage.set(this.options.storageName, {}) : null;
        //清除HTML
        this.targetDom.innerHTML = this.rawHTML ? this.rawHTML : '';
        this.init();
        //监听回调
        'update' in this.handlers ? this.emit('update', '') : null;
        this.options.onUpdate && this.options.onUpdate.call(this);
        callback && callback.call(this);
        return this;
    }
    destroy(callback) {
        //取消绑定事件
        this.flatData.forEach(k => {
            k.labelDom.onclick = null;
            k.arrowDom.onclick = null;
            k.checkDom ? k.checkDom.onclick = null : null;
            k.addDom ? k.addDom.onclick = null : null;
            k.editDom ? k.editDom.onclick = null : null;
            k.removeDom ? k.removeDom.onclick = null : null;
            k.otherTools.forEach(i => {
                i.dom.onclick = null;
            });
        });
        //取消异步请求
        this.contentXhr ? this.contentXhr.abort() : null;
        //更新销毁状态
        this.destroyed = true;
        //删除缓存
        this.options.storageName ? axLocalStorage.set(this.options.storageName, {}) : null;
        //监听回调
        'destroy' in this.handlers ? this.emit('destroy', '') : null;
        this.options.onDestroy && this.options.onDestroy.call(this);
        callback && callback.call(this);
        return this;
    }
    save(props, callback) {
        //如果已经销毁则不再执行
        if (this.destroyed) {
            return this;
        }
        //没有存储名则不再执行
        if (!this.options.storageName) {
            return false;
        }
        setTimeout(() => {
            //使用异步保存，避免拥堵
            let idsExpanded = this.flatData.filter(k => k.expanded).map(k => k.id).filter(Boolean),
                idsDisabled = this.flatData.filter(k => k.disabled).map(k => k.id).filter(Boolean),
                idsSelected = this.flatData.filter(k => k.selected).map(k => k.id).filter(Boolean),
                idsChecked = this.flatData.filter(k => k.checked).map(k => k.id).filter(Boolean),
                idsReadonly = this.flatData.filter(k => k.readonly).map(k => k.id).filter(Boolean);
            if (!props) {
                //保存当前焦点索引
                axLocalStorage.set(this.options.storageName, { expanded: idsExpanded, selected: idsSelected, checked: idsChecked, disabled: idsDisabled, readonly: idsReadonly, content: this.flatData });
            } else {
                //保存参数,props={}
                !props.hasOwnProperty('expanded') ? props.expanded = idsExpanded : null;
                !props.hasOwnProperty('disabled') ? props.disabled = idsDisabled : null;
                !props.hasOwnProperty('selected') ? props.selected = idsSelected : null;
                !props.hasOwnProperty('checked') ? props.checked = idsChecked : null;
                !props.hasOwnProperty('readonly') ? props.readonly = idsReadonly : null;
                !props.hasOwnProperty('content') ? props.content = this.flatData : null;
                axLocalStorage.set(this.options.storageName, props);
            }
            //回调监听
            let getValue = axLocalStorage.get(this.options.storageName);
            'save' in this.handlers ? this.emit('save', getValue) : null;
            this.options.onSave && this.options.onSave.call(this, getValue);
            callback && callback.call(this, getValue);
            return this;
        }, 0)
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
axInit('tree');