# PHP常用工具库

## 已实现功能

### 数组处理
- [x] `intervalArrToStr` 将数组转换为字符间隔字符串
- [x] `arrayMultipleSort` 二维数组排序
- [x] `filterNullByArr` 过滤一维数组中为null的值
- [x] `filterNullByMultipleArr` 过滤多维数组中为null的值

### 时间处理
- [x] `millisecond` 获取毫秒时间戳
- [x] `getAgeByBirthDate` 根据出生时间获取年龄
- [x] `humanizeTime` 获取人性化时间
- [x] `calculationTime` 计算时长

### HTTP处理
- [x] `httpBuildQueryNoEncode` 将数组转换为http请求参数，不进行编码，与http_build_query相对应

### IP处理
- [x] `getIPArea` 获取IP地址的归属地
- [x] `getClientIP` 获取客户端IP地址 

### JSON处理
- [x] `jsonEncode` 编码为json，中文编码为Unicode
- [x] `jsonDecode` JSON解码

### 判断
- [x] `mobileDeviceType` 判断手机设备为Android或IOS
- [x] `isIos` 是否为IOS
- [x] `isAndroid` 是否为Android
- [x] `isWeChat` 是否为微信客户端
- [x] `isIPad` 是否为IPad
- [x] `isIPhone` 是否为IPhone
- [x] `isMobile` 是否为手机设备
- [x] `isJson` 是否为JSON
- [x] `isEmail` 是否为电子邮箱
- [x] `isUrl` 是否为URL, URL后面必须为/
- [x] `isIp` 是否为IP地址
- [x] `isMacCode` 是否为MAC地址
- [x] `isTelephone` 是否为固定电话
- [x] `isStrExists` 字符串中是否存在指定字符
- [x] `isIe` 是否为IE浏览器
- [x] `isAjax` 是否为AJAX请求
- [x] `isUTF8` 字符串是否为UTF-8编码
- [x] `isLinux` 是否为Linux
- [x] `isWindows` 是否为Windows

### 手机号处理
- [x] `getMobileArea` 获取手机号的归属地

### 数值处理
- [x] `humanizePrice` 获取人性化价格

### 分页处理
- [x] `getPageInfo` 生成并获取分页信息

### 字符串处理
- [x] `intervalStrToArr` 将字符间隔字符串转换为数组
- [x] `hidePhoneNumber` 隐藏手机号码的某些字符
- [x] `underlineToHump` 下划线字符串转驼峰字符串
- [x] `humpToUnderline` 驼峰字符串转下划线字符串
- [x] `byteFormat` 格式化字节