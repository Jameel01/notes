# call()方法、apply()方法、bind()方法的用法与区别

	call()与apply()这两个方法的用途都是在特定的作用域中调用函数，实际上等于设置函数体内 this 对象的值。
	bind()这个方法会创建一个函数的实例，其 this 值会被绑定到传给 bind()函数的值。
	
### apply()方法、call()方法、bind()方法的用法

	1.apply()方法接收两个参数：一个是在其中运行函数的作用域，另一个是参数数组。
	其中，第二个参数可以是 Array 的实例，也可以是arguments 对象。例子如下
```javascript
	function sum(num1, num2){
		return num1 + num2;
	}
	function callSum1(num1, num2){
		return sum.apply(this, arguments); // 传入 arguments 对象
	}
	function callSum2(num1, num2){
		return sum.apply(this, [num1, num2]); // 传入数组
	}
	alert(callSum1(10,10)); //20
	alert(callSum2(10,10)); //20
```

	2.call()第一个参数是 this 值没有变化，变化的是其余参数都直接传递给函数，在使用
	call()方法时，传递给函数的参数必须逐个列举出来，例子如下
```javascript	
	function sum(num1, num2){
		return num1 + num2;
	}
	function callSum(num1, num2){
		return sum.call(this, num1, num2);
	}
	alert(callSum(10,10)); //20
```		
	3.bind()方法使用
	
```javascript
	window.color = "red";
	var o = { color: "blue" };
	function sayColor(){
	alert(this.color);
	}
	var objectSayColor = sayColor.bind(o);
	objectSayColor(); //blue
```
	在这里， sayColor()调用 bind()并传入对象 o，创建了 objectSayColor()函数。 objectSayColor()函数的 this 值等于 o，
	因此即使是在全局作用域中调用这个函数，也会看到"blue"。
	支持 bind()方法的浏览器有 IE9+、 Firefox 4+、 Safari 5.1+、 Opera 12+和 Chrome。
	
### 使用call与apply的好处

	1.能够扩充函数赖以运行的作用域，例子如下 
```javascript	
	window.color = "red";
	var o = { color: "blue" };
	function sayColor(){
		alert(this.color);
	}
	sayColor(); //red
	sayColor.call(this); //red
	sayColor.call(window); //red
	sayColor.call(o); //blue
```	
	2.使用 call()（或 apply()）来扩充作用域的最大好处，就是对象不需要与方法有任何耦合关系。
	
### call与apply选用

	使用 apply()还是 call()，完全取决于你采取哪种给函数传递参数的方式最方便。
	如果你打算直接传入 arguments 对象，或者包含函数中先接收到的也是一个数组，那么使用 apply()
	肯定更方便；否则，选择 call()可能更合适。（在不给函数传递参数的情况下，使用哪个方法都无所
	谓。）
	
