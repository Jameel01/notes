## 修改源
```
//改为淘宝镜像
npm config set registry http://registry.npm.taobao.org/
```
```
//改为官方源
npm config set registry https://registry.npmjs.org/
```
## 清除缓存
```
npm cache clean -f
```
## 安装cnpm
```
npm i cnpm -g
```
## npm,yarn查看源和换源
```
npm config get registry  // 查看npm当前镜像源

npm config set registry https://registry.npm.taobao.org/  // 设置npm镜像源为淘宝镜像

yran config get registry  // 查看yarn当前镜像源

yarn config set registry https://registry.npm.taobao.org/  // 设置yarn镜像源为淘宝镜像
```
## 镜像源地址部分
```
npm --- https://registry.npmjs.org/

cnpm --- https://r.cnpmjs.org/

taobao --- https://registry.npm.taobao.org/

nj --- https://registry.nodejitsu.com/

rednpm --- https://registry.mirror.cqupt.edu.cn/

npmMirror --- https://skimdb.npmjs.com/registry/

deunpm --- http://registry.enpmjs.org/
```
## 包安装不了原因
> * 网络原因 尝试用手机网络试试
> * node 版本问题 换成稳定的版本，最好是项目安装的node版本
> * npm 缓存问题 清缓存