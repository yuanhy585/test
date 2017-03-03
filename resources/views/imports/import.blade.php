
    <a href="#" class="btn btn-primary" onclick="document.getElementById('upFile').click()">
        选择文件
    </a>
    <input type="text" name="url" id="fileURL" class="form-control"/>
    <input type="file" name="file" id="upFile"
           onchange="document.getElementById('fileURL').value=this.value;"
           style="display: none;" />
    <button type="submit" class="btn btn-primary">
        确定
    </button>