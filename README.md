# NUKComment
<p>
這是大二的時候跟三個朋友一起寫的網頁，我當時負責的是DB+部分PHP。不過因為當時的資料庫是存放在系上機房，因此資料庫現在已經連不上了，在頁面查詢的時候只剩下模板，但還是上傳程式碼的部分上來保存
</p>

<p>
網頁的主要流程大致上是</br>
- index.php：首頁，選擇要查詢的開課系所、年級、教授名稱…等等。按下搜尋後進入下一個頁面</br>
- search.php：陳列搜尋結果的相關資料，在此頁可以依照這堂課程的各種分數排序。按下任一課程進入下一頁面</br>
- course.php：顯示這堂課的評語、評分等等</br>
</p>
<p>
這邊也介紹一些比較特別的檔案</br>
- nuk.php：在course.php頁面中，點選任一評語的鈕扣(讚)，會開始跑AJAX，本頁負責處理AJAX相關資料</br>
- dislike.php：同上，負責的是倒讚的資料</br>
</p>
其他還有像是註冊、登入、寫評論等等，比較直觀的就不贅述了
