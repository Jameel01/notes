## Jameel01的博客

### 将arguments转换成数组的方法
    将函数里的arguments，转换成一个真正的数组的方法，arguments是个类数组，除了有实参所组成的类似数组以外，还有自己的属性，如callee，arguments.callee就是当前正在执行的这个函数的引用，它只在函数执行时才存在。因为在函数开始执行时，才会自动创建第一个变量arguments对象。
