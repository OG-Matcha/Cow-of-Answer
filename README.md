## 如何開啟專案
> [!IMPORTANT]  
> 請按照順序完成下列步驟

### 安裝 WSL2
> [!TIP]
> 如果你的電腦已經裝過 WSL2 可跳過此步驟

我們需要先安裝 WSL2 供 Docker 使用

1. 用**系統管理員**身分打開 CMD 後輸入下面指令並執行 (啟用 WSL)
    ```bash=
    dism.exe /online /enable-feature /featurename:Microsoft-Windows-Subsystem-Linux /all /norestart
    ```
    
2. 用**系統管理員**身分打開 CMD 後輸入下面指令並執行 (啟用虛擬機器功能)
    ```bash=
    dism.exe /online /enable-feature /featurename:VirtualMachinePlatform /all /norestart
    ```
    
3. 下載並安裝 Linux 核心更新套件
    - [適用於 x64 系統](https://wslstorestorage.blob.core.windows.net/wslblob/wsl_update_x64.msi)
    - [適用於 ARM 系統](https://wslstorestorage.blob.core.windows.net/wslblob/wsl_update_arm64.msi)

4.  重新啟動你的電腦

5. 將 WSL 2 設定為預設版本
    ```bash=
    wsl --set-default-version 2
    ```
    
6. 安裝 Ubuntu 20.04.6 LTS
    - 到 Microsoft Store 搜尋 Ubuntu
    - 找到 **Ubuntu 20.04.6 LTS**
    - 選擇 **取得**，並且選擇 **安裝**

7. 設定帳號密碼
    - 第一次開啟 Ubuntu 會要求你輸入一組帳號密碼
    - 輸入密碼時如果沒有顯示密碼是正常的，這樣可以避免密碼被看到


### 安裝 Docker
在這個專案中，我們需要安裝 [Docker](https://www.docker.com/get-started/) 來去執行專案。

### 安裝專案
我們使用 Git 做版本控制，請先確定你的電腦有安裝 [Git](https://git-scm.com/download/win)，並且有一個 [Github](https://github.com/) 帳號

接下來你可以選一個舒適的地方來複製專案的資料夾，在你想放新專案的路徑下打開 CMD 輸入並執行下面的指令
```
git clone https://github.com/OG-Matcha/Cow-of-Answer.git
```

接下來你的檔案結構應該會像這樣
```
your_folder/
└── Cow-of-Answer/
    ├── frontend/
    ├── backend/
    ├── mysql/
    ├── redis/
    ├── nginx/
    └── docker-compose.yaml
```

接下來你要再次開啟 CMD 並確定你的路徑在 **Cow-of-Answer** 那一層
(也就是 **docker-compose.yaml** 所在的階層)，可以使用下面的指令去改變 CMD 當前路徑
```
cd <想進入的資料夾路徑>
```
然後在 CMD 執行下面指令 (確保你的 docker 是開啟的)
```
docker-compose up -d
```
就可以開始建立 docker 的映像檔及容器，建立完畢後即可在 Docker Desktop 中去執行容器開始進行專案開發

> [!IMPORTANT]  
> 請自行學習 Git 中的 add, commit, push 以及 branch 該如何使用 
## 創建你的分支

在開始編輯專案前請先建立你的 Git 分支

```
git checkout -b <your name>
```

當你完成部分進度時，請記得適時推送上 Github

```
git push
```

**永遠不要直接給我推送到 main 分支 !!!**

## Git Commit 規則

init: 初始化專案

add: 新增項目（但功能未完成）

feat: 新增功能（功能已完成）

RWD: RWD 的功能修正

chore: 雜務（如新增附件檔、上傳字體檔等等）

fix: 修正 bug 或 issue


hotfix: 「即時」修正嚴重 bug

範例：

- 上傳圖片、字型: "chore: upload images and fonts"
- 修正部分裝置的 RWD: "RWD: adjust layout on tablet"
- 完成桌機頁面: "feat: complete desktop and tablet layout"

> [!NOTE]  
> 這部分非常重要，請建立良好的 commit 習慣及規則

## 前端檔案架構
[Nuxt 檔案架構](https://github.com/OG-Matcha/NCU_Web_Final/blob/main/FRONTEND.md)

## 後端檔案架構
[Laravel 檔案架構](https://github.com/OG-Matcha/NCU_Web_Final/blob/main/BACKEND.md)

## 命名規則
> [!IMPORTANT]
> 請嚴格遵照命名規則及檔案架構的內容

### 前端
請遵照 [Style Guide](https://vuejs.org/style-guide/) 等級至少到 **B**

### 後端
請按照 [Laravel 的命名原則](https://www.icat.tw/laravel-naming/) 進行命名

### 資料庫
請按照 [資料庫命名規則及設計規範](https://thecolormoon.blogspot.com/2015/10/2015093002.html) 進行資料庫設計

## 使用框架及技術
- Frontend : **Nuxt3 + TailwindCSS**

- Backend : **PHP + Laravel**

- Database : **MySQL + Redis + Adminer**

- WebServer: **Nginx**
