# DOM事件类
## DOM事件的级别
1. DOM0 element.onclick = function(){}<br>
2. DOM2 element.addEventListener("click",function(){},false)<br>
3. DOM3 element.addEventListener("keyup",function(){},false)
## DOM事件模型
捕获：从上到下<br>
冒泡：从下到上
## DOM事件流
window对象=>捕获=>目标阶段=>冒泡=>window对象
## DOM事件捕获的具体流程
window=>document=>html(document.documentElement)=>body=>...=>目标元素
## 事件绑定
element.addEventListener("click",function(){},false)（最后一个参数false表示冒泡阶段触发，true表示捕获阶段触发）
```html
<body>
    <div id="ev">
        目标元素
    </div>
    <script>
        var ev = document.getElementById('ev');
        /********************捕获阶段触发***************************/
        window.addEventListener('click',function(){
            console.log('window captrue')
        },true);
        document.addEventListener('click',function(){
            console.log('document captrue')
        },true);
     
        document.documentElement.addEventListener('click',function(){
            console.log('html captrue')
        },true);
        document.body.addEventListener('click',function(){
            console.log('body captrue')
        },true);
        ev.addEventListener('click',function(){
            console.log('ev captrue')
        },true);
        /******************冒泡阶段触发**********************/
        window.addEventListener('click',function(){
            console.log('window captrue')
        }, false);
        document.addEventListener('click',function(){
            console.log('document captrue')
        }, false);
     
        document.documentElement.addEventListener('click',function(){
            console.log('html captrue')
        }, false);
        document.body.addEventListener('click',function(){
            console.log('body captrue')
        }, false);
        ev.addEventListener('click',function(){
            console.log('ev captrue')
        }, false);
        
    </script>
</body>
```
触发顺序：<br>
window captrue <br>
document captrue<br>
html captrue<br>
body captrue<br>
ev captrue<br>
ev captrue<br>
body captrue<br>
html captrue<br>
document captrue<br>
window captrue
## Event对象的常见应用
1. event.preventDefault()（阻止默认行为）<br>
2. event.stopPropagation()（阻止冒泡）<br>
3. event.stoplmmediatePropagation()（事件响应优先级，在优先级高的事件中加入该函数，可以阻止优先级低的函数执行）<br>
4. event.currentTarget（当前所绑定的事件）<br>
5. event.target（当前被点击的元素）
## 自定义事件
```js
var eve = new Event('custome');
ev.addEventListener('custome',function(){console.log('custome')});
ev.dispatchEvent(eve);
```
customEvent与Event都可以创建自定义事件，customEvent可以加数据
