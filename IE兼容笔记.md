### 库的引入
```javascript
<!--[if lte ie 9]>
  ie9及以下引入文件...
<![endif]-->
```
### 小细节
* ie9不支持base相对路径需要写完整的路径。
```html
<base href="http://localhost:8080/../)">
```
### 去除img默认上下间距
```css
img{vertical-align:top}
```
