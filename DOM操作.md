## 创建节点
>创建一个完整节点需要两步<br>
>1. var oLi = document.creatElement('li');//创建节点，但还不会在文档中显示<br>
>2. var oUl.appendChild(oLi);//在父节点里面，尾部添加节点，显示在文档中<br>
>3. var oUl.insertChild('oLi');//在父节点里面，首位添加节点，显示在文档中
### 实例
```javascript
var oUl = document.getElementById('ul1');
  var oBtn = document.getElementById('btn1');
  oBtn.onclick = function(){
    var time1 = new Date().getTime();//获取当前时间
      for(var i=0;i<10000;i++){
        var oLi = document.createElement('li');//创建节点
        oLi.innerHTML = 'li';//在子节点中添加内容
        oUl.appendChild(oLi);//添加子节点
    }
    var time2 = new Date().getTime()-time1;//计算time1-time2中的程序的运行时间
    alert(time2);
  };
```
### 从头插入子节点
```javascript
var oUl = document.getElementById('ul1');
  var oBtn = document.getElementById('btn1');
  var aLi = document.getElementsByTagName('li');
  oBtn.onclick = function(){
    var time1 = new Date().getTime();//获取当前时间
      for(var i=0;i<10;i++){

         var oLi = document.createElement('li');//创建节点
         oLi.innerHTML = i+'<a href="javascript:;">删除</a>';//在子节点中添加内容

        if(!aLi[0]){
            oUl.appendChild(oLi);//尾部添加子节点
        }else {
            oUl.insertBefore(oLi,oUl.children[0]);//头部添加子节点
        }
    }
    var time2 = new Date().getTime()-time1;//计算time1-time2的运行时间
    alert(time2);//显示运行时间
    //点击li中的删除就可以删除本个li
    var aA = oUl.getElementsByTagName('a');
      for(var i=0; i<aA.length; i++){
          aA[i].onclick = function(){
            oUl.removeChild(this.parentNode);//删除子节点
          }
        }
  };
```

