# 页面布局
## 假设高度已知，请写出三栏布局，其中左栏和右栏固定宽度，中间自适应。
### 布局方法
#### float
优点：兼容性好<br>
缺点：需要处理好浮动问题，要清浮动,高度改为不固定则不能正常使用<br>
常用清浮动方法：<br>
1. overflow：hidden/auto(需要配合宽度) <br>
2. .clear:after{clear:both;display:block;content:"";height:0}<br>
3. 父级同时加浮动
#### position:absolute
优点：布局快<br>
缺点：对页面整体影响大,高度改为不固定则不能正常使用<br>
#### flex
没有明显的缺点，高度改为不固定也可以正常使用，推荐使用
#### table
没有明显缺点，需要注意的是同行元素会自动等高,高度改为不固定也可以正常使用
#### grid
新技术高效快捷，IE部分兼容，高度改为不固定不能正常使用

## 实例代码
```html
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    body{
        padding:0;
        margin:0;
    }
    .layout div{
        min-height: 300px;
    }
    .layout{
        margin-top:20px;
    }
        /*************float*****************/

    .float .left{
        width: 300px;
        float:left;
        background-color: antiquewhite;
    }
    .float .center{
        background-color: aquamarine;
        min-width: 100px;
    }
    .float .right{
        width: 300px;
        float:right;
        background-color: beige;
    }
        /***************absolute********************/
    .absolute .left{
        position: absolute;
        width: 300px;
        left:0;
        background-color: antiquewhite;
    }
    .absolute .center{
        left:300px;
        right:300px;
        background-color: aquamarine;
        position: absolute;
        min-width: 100px;
    }
    .absolute .right{
        width: 300px;
        right:0;
        background-color: beige;
        position: absolute;
    }
        /********************flex**************************/
    .FlexBox article{
        display:flex;
    }
    .FlexBox .left{

        width: 300px;

        background-color: antiquewhite;
    }
    .FlexBox .center{

        background-color: aquamarine;

        min-width: 100px;
        flex:1;/*核心*/
    }
    .FlexBox .right{
        width: 300px;

        background-color: beige;

    }
        /*******************table********************/
    .table article{
        width: 100%;
        display: table;
        height: 300px;
    }
    .table article>div{
        display: table-cell;
    }
    .table .left{

        width: 300px;

        background-color: antiquewhite;
    }
    .table .center{

        background-color: aquamarine;

    }
    .table .right{
        width: 300px;

        background-color: beige;

    }
        /****************grid***********************/
    .grid article{
        display: grid;
        width: 100%;
        grid-template-rows: 300px;
        grid-template-columns: 300px auto 300px;
    }
    .grid .left{
        background-color: antiquewhite;
    }
    .grid .center{
        background-color: aquamarine;
    }
    .grid .right{
        background-color: beige;
    }
    </style>
    <script type="text/javascript">

    </script>
  </head>
  <body>
   <section class="layout float">
     <article>
       <div class="left"></div>

       <div class="right"></div>
     <div class="center">
         <h1>浮动解决方案</h1>
         <p>假设高度已知，请写出三栏布局，其中左右栏宽度300px，中间自适应</p>
     </div>
     </article>
   </section>


   <section class="layout FlexBox">
      <article>
          <div class="left"></div>
          <div class="center">
              <h1>flexbox解决方案</h1>
              <p>假设高度已知，请写出三栏布局，其中左右栏宽度300px，中间自适应</p>
          </div>
          <div class="right"></div>

      </article>
  </section>
   <section class="layout table">
      <article>
          <div class="left"></div>
          <div class="center">
              <h1>table解决方案</h1>
              <p>假设高度已知，请写出三栏布局，其中左右栏宽度300px，中间自适应</p>
          </div>
          <div class="right"></div>

      </article>
  </section>
   <section class="layout grid">
      <article>
          <div class="left"></div>
          <div class="center">
              <h1>网格布局解决方案</h1>
              <p>假设高度已知，请写出三栏布局，其中左右栏宽度300px，中间自适应</p>
          </div>
          <div class="right"></div>

      </article>
  </section>
   <section class="layout absolute">
       <article>
           <div class="left"></div>
           <div class="center">
               <h1>绝对定位解决方案</h1>
               <p>假设高度已知，请写出三栏布局，其中左右栏宽度300px，中间自适应</p>
           </div>
           <div class="right"></div>

       </article>
   </section>
  </body>
</html>

```
