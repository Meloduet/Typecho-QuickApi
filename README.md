# Typecho QuickApi

## 简介

QuickApi是一个Typecho博客程序的即插即用插件, 它的功能是对外开放Typecho的一些功能, 如获取文章, 获取分类等.

## 警告

本插件正在完善中, 请暂时不要使用.

## 使用方法

把QuickApi上传到你的博客即可.

## Api调用说明

**调用地址:** `http(s)://你的网站地址/index.php/quickapi` 如: `http://127.0.0.1/typecho/index.php/quickapi`

**并全部使用POST方式.**



### 获取文章和页面及其内容

| 参数     | 值类型    | 值            | 说明      |
| ------ | ------ | ------------ | ------- |
| act    | string | get_contents | 表明调用的函数 |
| offset | int    | /            | 偏移量     |
| limit  | int    | /            | 数量      |

#### 示例

act: get_contents, offset: 0, limit 10

返回: 数组, 长度为10
```json
[
  {
    "cid": "1"
    "slug": "start"
    "title": "欢迎使用 Typecho"
    "text": "<!--markdown-->如果您看到这篇文章,表示您的 blog 已经安装成功."
    "commentsNum": "1"
    "created": "1475577846"
    "modified": "1475577846"
  }
  {
    "cid": "2"
    "slug": "start-page"
    "title": "关于"
    "text": "<!--markdown-->本页面由 Typecho 创建, 这只是个测试页面."
    "commentsNum": "0"
    "created": "1475577846"
    "modified": "1475577846"
  }
  ...
```

另: act=get_brief_contents是该接口的简短版本, 只返回`'cid','slug','title','commentsNum'`

### 获取文章和页面的总数

| 参数   | 值类型    | 值                  | 说明    |
| ---- | ------ | ------------------ | ----- |
| act  | string | get_contents_count | 调用的函数 |



#### 返回示例

```json
{
	"count": "12"
}
```



### 获取所有文章分类

| 参数   | 值类型    | 值              | 说明    |
| ---- | ------ | -------------- | ----- |
| act  | string | get_categories | 调用的函数 |

#### 返回示例

```json
[
  {
    "mid": "1"
    "name": "默认分类"
    "slug": "default"
    "description": "只是一个默认分类"
    "count": "9"
    "order": "1"
    "parent": "0"
  }
```



### 获取文章所属分类

| 参数   | 值类型    | 值                   | 说明    |
| ---- | ------ | ------------------- | ----- |
| act  | string | get_category_by_cid | 调用的函数 |
| cid  | int    | /                   | 文章id  |

#### 示例

传入cid=1, 返回:

```json
{
  "mid": "1"
  "name": "默认分类"
  "slug": "default"
  "description": "只是一个默认分类"
  "count": "9"
  "order": "1"
  "parent": "0"
}
```



### 获取分类下所有文章

| 参数   | 值类型    | 值               | 说明    |
| ---- | ------ | --------------- | ----- |
| act  | string | get_cids_by_mid | 调用的函数 |
| mid  | int    | /               | 分类id  |

#### 示例

传入mid=1(默认分类), 返回

```json
[1,3,4,5,6,7,8,9,10]
```

