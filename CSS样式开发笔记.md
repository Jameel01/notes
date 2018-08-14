## CSS样式开发笔记

### 目录
> * [input输入光标](#01)
> * [去除img自带垂直间隙](#02)
> * [滚动监听](#03)
> * [文本字数限制超显示省略号](#04)
> * [垂直居中](#05)
> * [布局](#06)
> * [web和app适配](#07)
> * [渐变](#08)
> * [文本样式](#09)
> * [input IE下样式差异](#10)
> * [rem 移动端适配](#11)

<h2 id='01'>input输入光标</h2>

```css
input{
 
  caret-color: #65a6ff;
}
```
---
<h2 id='02'>去除img自带垂直间隙</h2>

```css
img{
    vertical-align: top;
}
```
---
<h2 id='03'>滚动监听</h2>

> 滚动监听，需要取得window对象的，不能是document，否则IE8识别不了


```javascript
 $(window).scroll(function () {
        var scroll = 400;
        if ($(document).scrollTop() > scroll) {
          $('.nav').addClass('toFixed')
        } else {
          $('.nav').removeClass('toFixed')
        }
      })
    })
```
---
<h2 id='04'>文本字数限制超显示省略号</h2>

```css
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 7;
  overflow: hidden;
```
---
<h2 id='05'>垂直居中</h2>



```css
  display: inline-block;
  vertical-align: middle;
```
---
<h2 id='06'>布局</h2>

> * 水平排列:
> * float+width%
> * 固定元素在相对位置:
> * float+margin
---

<h2 id='07'>web和app适配</h2>

> * web：max-width:1000px(ipad pro 1024px)
> * app: @media(min-width:320) and (max-width:1000px)
---

<h2 id='08'>渐变</h2>

```css
  background: linear-gradient(to right,#6083C3, #6A99E7);
```
---
<h2 id='09'>文本样式</h2>


> * 文本缩进：text-indent
> * 文本对齐：direction：rtl/ltr
> * pre标签：pre 元素可定义预格式化的文本。被包围在 pre 元素中的文本通常会保留空格和换行符。而文本也会呈现为等宽字体。

```css
.layout-text{
    white-space: normal;
    pre{
        white-space: pre-wrap;
        word-wrap: break-word;
    }
}
```
```html
<div class="layout-text">

  <pre >值班室电话：5327743   传真：5327743
    （一）办公室
    综合协调局机关和直属单位工作，督促重大事项的落实；负责局机关的文电、会务、机要、档案、信息、信访、安全、保密、政务公开、效能建设等工作；承担新闻宣传工作；负责协调和落实建议、提案等的办理工作；管理局机关行政事务和国有资产等。
        处室负责人：钱飞鸣        
   </pre>
</div>

```  
<h2 id='10'>input IE下样式差异</h2>
> * 设置固定高度 height: 30px;
> * 设置行高 line-height: 30px;
> * IE下input宽度会更宽些（多了删除按钮）

<h2 id='11'>rem 移动端适配</h2>
*rem：font size of the root element*
#### rem 数值计算
- 使用sass
```
    @function px2rem($px){
        $rem:37.5px;
        @return ($px/$rem) + rem;
    }
    
    height: px2rem(100px);
    width:px2rem(100px);
```
- rem基准值计算

选择确定的屏幕来作为参考，这里为什么要除以10呢，其实这个值是随便定义的,因为不想让html的font-size太大，当然也可以选择不除，只要在后面动态js计算时保证一样的值就可以
```
iphone3gs: 320px / 10 = 32px

iphone4/5: 320px  / 10 = 32px

iphone6: 375px  / 10 =37.5px
```
- 动态设置HTML的font-size

方法一：css
```css
@media (min-device-width : 375px) and (max-device-width : 667px) and (-webkit-min-device-pixel-ratio : 2){
      html{font-size: 37.5px;}
}
```
方法二：js
```javascript
document.getElementsByTagName('html')[0].style.fontSize = window.innerWidth / 10 + 'px';
```
#### rem适配进阶
1. 可以完全按照视觉稿上的尺寸，不用除2
2. 解决了图片高清问题
3. 解决了border 1px 问题（我们设置的1px，在iphone上，由于viewport的scale是0.5，所以就自然缩放成0.5px）
4. 我们使用动态设置viewport，在iphone6下，scale会被设置成1/2即0.5，其他手机是1/1即1


```css
// sass
html {
    font-size: 37.5px;
}

@function rem($px) {
    $rem: 37.5;
    @return ($px/$rem)+rem;
}

width:rem(100);
```

```html
<head>
    <meta charset="UTF-8">
     <!-- 编码设置 -->
    <meta charset="UTF-8">
    <!-- 渲染核心选择 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 缩放控制 -->
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
</head>
```
```javascript
window.onload = function () {
    function autoMeta() {
       var dpr = window.devicePixelRatio;//dpr
       
        document.getElementsByTagName('html')[0].style.fontSize = window.innerWidth / 10 + 'px';//设置html字号
        
        var meta = document.getElementsByTagName('meta')['viewport'];
        
        meta.setAttribute('content',"initial-scale=" + 1 / dpr + ", maximum-scale=" + 1 / dpr + ", minimum-scale=" + 1 /dpr + ", user-scalable=no")//缩放控制
    }
    autoMeta()// 自动计算缩放和html字号
}
```