## call()方法与apply()方法的用法与区别

	这两个方法的用途都是在特定的作用域中调用函数，实际上等于设置函数体内 this 对象的值。
	
### apply()方法和call()方法的用法

	1.apply()方法接收两个参数：一个是在其中运行函数的作用域，另一个是参数数组。
	其中，第二个参数可以是 Array 的实例，也可以是arguments 对象。例子如下
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

	2.call()第一个参数是 this 值没有变化，变化的是其余参数都直接传递给函数，在使用
	call()方法时，传递给函数的参数必须逐个列举出来，例子如下
	
		function sum(num1, num2){
			return num1 + num2;
		}
		function callSum(num1, num2){
			return sum.call(this, num1, num2);
		}
		alert(callSum(10,10)); //20
	
### 使用call与apply的好处

	1.能够扩充函数赖以运行的作用域，例子如下 
	
		window.color = "red";
		var o = { color: "blue" };
		function sayColor(){
			alert(this.color);
		}
		sayColor(); //red
		sayColor.call(this); //red
		sayColor.call(window); //red
		sayColor.call(o); //blue
	
	2.使用 call()（或 apply()）来扩充作用域的最大好处，就是对象不需要与方法有任何耦合关系。
	
### call与apply选用

	使用 apply()还是 call()，完全取决于你采取哪种给函数传递参数的方式最方便。
	如果你打算直接传入 arguments 对象，或者包含函数中先接收到的也是一个数组，那么使用 apply()
	肯定更方便；否则，选择 call()可能更合适。（在不给函数传递参数的情况下，使用哪个方法都无所
	谓。）
	
## 将arguments转换成数组的方法

	将函数里的arguments，转换成一个真正的数组的方法，arguments是个类数组，除了有实参所组成的类似数组以外，
	还有自己的属性，如callee，arguments.callee就是当前正在执行的这个函数的引用，它只在函数执行时才存在。
	因为在函数开始执行时，才会自动创建第一个变量arguments对象。
