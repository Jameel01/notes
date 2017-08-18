### cookie用法
>document.cookie<br>
document.cookie = "user=json;expires"+oDate;//不会覆盖只会添加<br>
document.cookie移除只需将有效日期设为-1<br>
document.cookie获取，cookie格式：user=json; pass=12120<br>
  1.将cookie内容以'; '切割存入数组arr<br>
  2.再将arr的内容以'='切割存入数组arr2，如果arr2[0]（名称）等于所要读取的内容，则返回arr2[1]（值）<br>
### 关于各浏览器之间对cookie的不同限制见下：
 > IE6.0：每个域为20个，4095个字节<br>
  IE7.0/8.0：每个域为50个，4095个字节<br>
  Opera：每个域为30个，4095个字节<br>
  Firefox：每个域为50个，4096个字节<br>
  Safari：没有个数限制，4097个字节<br>
  Chrome：每个域为53个，4097个字节<br>   
#### 超出个数限制后的处理操作：
  >1、IE与Opera的处理是一样的。他们都利用“最近最少使用算法”，当cookie已经达到限额时就将自动剔除最老的cookie，以给最新的cookie的留下可用的空间。<br> 
  2、FF很特殊，虽然最后设置的cookie会被保留下来，但它好像没有什么章法随机进行删除已存在的cookie。
  ### Flash cookie
>同Http Cookie一样，Flash Cookie也就是记录用户在访问Flash网页的时候保留的信息，鉴于Flash技术的普遍性，几乎所有的网站都采用，所以具有同Http Cookie一样的作用。
<br>但是相比起Http Cookie，Flash Cookie更加强大：<br>1、容量更大，Flash Cookie可以容纳最多100千字节的数据，而一个标准的HTTP Cookie只有4千字节;<br>
2、Flash Cookie没有默认的过期时间;<br>3、Flash Cookie将被存储在不同的地点，这使得它们很难被找到。
  ## 写入cookie
```javascript
function setCookie(name,value,iDate){
  var oDate = new Date();//新建Date对象
  oDate.setDate(oDate.getDate()+iDate);//设置日期
  document.cookie = name+'='+value+';expires='+oDate;//写入cookie，expires过期时间
}
```    
### 获取cookie
```javascript
function getCookie(name){
  var arr = document.cookie.split('; ');//以'; '切割成数组
  for(var i=0;i<arr.length;i++){
    var arr2 = arr[i].split('=');//以'= '切割成数组
    if(arr2[0] == name){//如果名称匹配
      return arr2[1];//返回值
    }
  }
  return '';//没有cookie返回空字符
}
```
### 移除cookie
```javascript
function removeCookie(name){
    setCookie(name,'1',-1);//将日期设置为过期，浏览器将自动删除cookie
  }
```
### 实例应用-记住用户名
```javascript
window.onload = function(){
    var oForm = document.getElementById('form1');
    var oUser = document.getElementsByName('user')[0];
    var oBtn = document.getElementsByTagName('a')[0];
    oForm.onsubmit = function(){
      setCookie('user','fulank',30);//设置cookie
    }
    oUser.value = getCookie('user');//显示cookie在用户输入框中
    oBtn.onclick = function(){
      removeCookie('user');//移除cookie
      oUser.value = '';//清空用户输入框
    }
  }
```
```html
<body>
//用户登录表单
<form id="form1" action="">
	UserName:<input type="text" name="user">
	pass:<input type="password" name="pass">
	<input type="submit" value="Sign in">
	<a href="javascript:;">clear</a>
</form>
</body>
```
