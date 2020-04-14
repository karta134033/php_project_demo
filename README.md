# 資料庫助教課程  專題
## 課程影片
https://drive.google.com/file/d/1ikLY23qbJBHw7ysVpgQjqBIQEvAAKEOb/view?usp=sharing
## Demo網址
**主要以PC端網頁呈現為主**，手機的版型未製作但功能仍可使用。
http://neil.nctu.me/php_project_demo/view/blog.php
## 使用方法
1. 先將專案從 [這個連結](https://github.com/karta134033/php_project_demo/archive/master.zip) 拉下來 
2. 將專案資料夾整包放入 /xampp/htdocs/ 資料夾底下
    ![](https://i.imgur.com/cBgJDkm.png)
3. <font color="red">把資料夾檔名"php_project_demo-master" 改為 "php_project_demo"</font>   (沒有改會有路徑問題)
4. 開啟xampp 並打開Apache MySQL
![](https://i.imgur.com/SeYnsnV.png)
5. 輸入以下網址 
    http://127.0.0.1/php_project_demo/views/blog.php  
    即可看到專案
## 架構
```tree
│  README.md
│
├─models        (與資料庫存取有關)
│      article.php
│      article_check.php
│      db_check.php
│      login_check.php
│      registration_check.php
│
├─src        (存放靜態檔案 如:圖片)
│  ├─img
│  │      up-arrow.png
│  │
│  └─csv (此專案資料庫初始化所需要的資料)
│  
└─views        (與使用者視圖有關)
    │  blog.php           
    │  blog_nav.php
    │  login.php
    │  login_status.php
    │  login_nav.php
    │  registration.php
    │  write_article.php
    │
    ├─animations        (存放動畫相關的檔案)
    │      anime.js
    │      box_anime.php
    │      svg.php
    │
    └─include        (與引入檔有關 如:Bootstrap、JQuery)
            head.php
            md5.js
            style.css
```
## 設計理念
* 主架構取用自MVC(Model、View、Controller)架構的MV，為求Demo簡潔與容易而省去C。
若有興趣實作出完整的MVC架構可以參考以下的教學影片
[PHP實作MVC](https://www.youtube.com/watch?v=zOgzfMjgo30&list=PLfdtiltiRHWGXVHXX09fxXDi-DqInchFD&index=3)
**註:** MVC僅是設計方式與理念，期末專題並沒有硬性的規範，同學可以自由發揮。

* 為了減少資料干擾(ex:覆蓋掉同學原本寫好的檔案)，所以Demo以**資料夾整包**拉下來的方式作呈現，所以沒有實作路由機制，若同學想實作路由機制的話，請在xampp/htdocs/資料夾底下的 **"index.php"** 實作，做為網站的單一入口點。
    可以參考[Clean URL](https://ithelp.ithome.com.tw/articles/10194207)

* Views資料夾內的php檔設計方式仿造前端框架Vue.js的設計方式(依序為:Template、Script、Style)。
**註:** 設計方法沒限制，同學一樣可以自由發揮。
    * 例 
        ```html  
        <div class="container">  <-- Template
        ...略...
        </div>

        <script>  <-- Script
        ...略...
        </script>

        <style>  <-- Style
        ...略...
        </style>
        ```
## 學習重點
* 使用者登入  
    * /views/login.php
    * /views/login_status.php
    * /models/login_check.php
* 使用者註冊
    * /views/registration.php 
    * /models/registration_check.php
## 檔案解釋
* #### 進入點
    從 /views/login.php進入
    ![](https://i.imgur.com/Va2msaC.png)

    
* #### /models/db_check.php  <font color="red">請不要以此方法新增資料庫與資料表</font>
    <font color="red"><b>注意</b></font>
        為求demo方便才會以此方法新增，請同學實作時在 **"phpmyadmin"** 內下sql指令或是利用UI介面來新增資料庫與資料表。
        請參考以下的影片[新增資料庫、資料表 (看到3:44即可)](https://www.youtube.com/watch?v=RtGxY0Bct40) 新增
        
    ##### 簡介
    * 先建立資料庫連線  輸入servername、username、password
    * 確認是否有創建名稱為"user"的database，若無則新增。
    * 若無名稱為"user"的database會先創立此database，再接著創立table名稱為"user_account"、"user_article"、"user_message"的資料表，且隨著創立資料表後會匯入各自的csv檔做為資料庫初始化資料。
    * 最後回傳連線資訊
* #### /views/registration.php 
    ![](https://i.imgur.com/LjKqq2j.png)

    ##### 簡介
    * 86行 密碼經過md5加密(此md5加密方法為外部js，在/views/include/資料夾下)。 (建議同學在創建使用者的密碼時可以在前端或後端加密過後再上傳到資料庫)
    * 91行 以**Ajax**的方式將表單的內容以[網址query](https://www.php.net/manual/en/reserved.variables.get)的方式傳入到 /models/registration_check.php，等待結果回傳。
    * 94行 等待/models/registration_check.php echo的結果
    * 117行 **避免真的發送表單造成頁面重整**。
        ##### 名詞解釋:[Ajax](https://ithelp.ithome.com.tw/articles/10203820)、[md5](https://zh.wikipedia.org/wiki/MD5)
* #### /models/registration_check.php
    ##### 簡介
    * 2行 先引入/db_check.php 檔案做資料庫的確認
    * 5~6行 htmlspecialchars() :避免使用者夾雜html的非法輸入 
    * 5~6行 $_GET()取得網址所帶的query 註: [網址query](https://www.php.net/manual/en/reserved.variables.get)
    * 9行 取得資料庫連線資訊 註:此function在db_check.php內
    * 17行 以mysqli_num_rows()回傳的數字來評斷email、username有沒有被註冊過，如果數字大於0代表有被註冊過。
    * 34行 **$conn->close() 在程式最末段終止DB連線** (保持良好的設計習慣記得在做完資料庫的連線使用後關閉連線，釋放資源)

* #### /views/login.php 
    ##### 簡介
    * 6~8行 釋放SESSION所保留的使用者登入資訊
        ```php   
        unset($_SESSION['login']);
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        ``` 
    * 不同於/views/registration.php ajax的方式，這裡是實作傳統的表單發送介接後端的方式，發送方法為"GET"，不需等待回傳，且需頁面跳轉。
    * 54行 JS中的function "getUrlVars()" 用來取得網址所帶的參數，如果登入失敗 server會將網址帶上"?error=帳號密碼錯誤"，"getUrlVars()"會根據回傳內容顯示跳窗。
* #### /models/login_check.php
    ##### 簡介
    * 5行  
        ```php  
        isset($_GET['submit'])
        ```
        確保請求是從表單的"GET"方法，並由按鈕
        ```html
        <button 
            class="btn btn-lg btn-primary btn-block"  
            name="submit" 
            value="Login" 
            type="submit"
        ><b>登入</b></button>
        ```
        發送
    * 17行 以mysqli_num_rows()回傳的數字來評斷是否登入成功。
    * 23~26行 
        ```php
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];
        ```
        將使用者的登入資訊寫入到SESSION中，作為登入認證使用。
* #### /views/blog.php
    ![](https://i.imgur.com/AcqirFj.png)
    這裡比較複雜一點，與第二次作業無關，時間有限的同學可以略過
    ##### 簡介
    * 文章以傳統的php方式將結果印出到前端頁。
        優點: 資料同步於資料庫。
    * 留言功能以Ajax發送請求並以JS來拼湊頁面。
        優點: 使用者體驗佳(頁面不會重整)
    * 17~22行 與側邊的導向按鈕有關，按鈕會導向以文章主鍵"id"作為attribute的元素
    ![](https://i.imgur.com/faOWN5Y.png)
    * 39~86行 與blog內容有關，包含刪除按鈕、留言按鈕等...
    ![](https://i.imgur.com/XbsbY68.png)

* #### /views/write_article.php
    ![](https://i.imgur.com/THm1vyH.png)

    ##### 簡介
    * 跟註冊頁面一樣是發送ajax請求並等待回復。
    * 78行 此行是用來告訴後端這是發writeArticle的請求
    * 與註冊頁不同的是實作"圖片上傳功能"，做法為先將image轉為"Blob"再傳入"Canvas"做圖片壓縮，最後再將Canvas轉為"Base64Image"傳送到後端，後端再根據"Base64Image"做解碼。
        **圖片上傳的部分比較複雜，有需要用到再去理解，網路上很多不同的實作方法，別被此專案的做法侷限住了**。
        若無須使用者上傳則只要將圖放在後端(xampp/htdocs)即可。
    
* #### /models/article.php
    ##### 簡介
    * 與註冊、登入不同的是，此php檔是以class的方式實作，將新增與刪除寫在同一支檔案下。
    * 若要使用類別內的函式則需先將類別實體化
    * 此種實作方法較方便維護且能減少php檔案數量
* #### /models/article_check.php
    ##### 簡介
    * 5行 實體化 article.php內的ArticleClass()
    * 6行 根據/views/write_article.php 78行的請求做資料新增
    * 8~9行 將使用者資訊塞入
        註: 尚可在article.php內做使用者認證，加一層防護。
    * 新增與刪除都是利用ArticleClass()內的方法。
## Q&A
1. Q: 圖片沒寫進去，或無法顯示圖片
    A: **Mac**或**Linux**系統可能會有遇到圖片沒寫進去的問題，
    解決方法: 將xampp的資料夾全開，指令如下。
    ```sh
    sudo chown 777 -R /找到你/xampp/的路徑/並替換掉這一段
    
    如:  我的xampp路徑在  "/opt/lampp/"
    則需要在終端機下:   sudo chown 777 -R /opt/lampp/
    ```
2. 
    Q: 手機頁面沒有自動縮放
    A: 此專案沒有做RWD的形式，若有興趣的同學可以參考[CSS RWD](https://www.ucamc.com/e-learning/css/102-rwd-css-media-type)做網頁切版

3. Q: 手機上傳圖片最後會變成橫向的 
    A: 目前還找不到產生此問題的癥結點，因此還無法解決。
    
4. Q: 可以使用php相關的框架嗎?
    A: 不建議使用，雖然框架好寫好用好維護，但需要對資料庫與php語法有中等程度的認知，另外還需要對環境架設、作業系統環境與系統指令有概念，再進階一點的會牽涉到虛擬化、容器化的技術。本課程的宗旨還是以學習php與資料庫為主，待課程結束後對php與資料庫有基本認知後可以再試著用框架的方式玩看看專案，若有興趣之後也能再與我討論。
    
## 第二次作業
### 用Cookies認證使用者登入
* 請用**php**實作**Cookies**的寫入與使用者認證，**禁用JavaScript**、**禁止照抄這個專案的版型(如登入、註冊的畫面)**
* 將功能**移植到個人簡介作業**的首頁上
    * 加上 ”登入” 按鈕, 連結到 login.php
    * 登入後顯示使用者資訊 （名稱、性別...）
    * 配合 Cookies 紀錄登入狀態 
    * 加上 ”修改密碼” 的按鈕, 連結到 reset_password.php
        * 要有三個欄位： 一、輸入舊密碼 二、輸入新密碼 三、確認新密碼
            測試是否能使用修改後的帳密登入

### 繳交方式
作業須包含
1. HW3_學號_姓名.pdf
截圖並簡單說明功能，至少需包含：
資料庫欄位
註冊、登入、修改密碼 頁面
報告無須貼上程式
2. code    
.html .php ... 

一併壓縮成HW3_學號_姓名.zip
### 繳交期限
會公布在e3上

## 總結
**會google比較重要**
