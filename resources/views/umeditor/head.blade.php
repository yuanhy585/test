
@section('css')
    <link rel="stylesheet" href="/umeditor/themes/default/css/umeditor.min.css">
@append

@section('js')
    <script src="/umeditor/umeditor.config.js"></script>
    <script src="/umeditor/umeditor.min.js"></script>
    <script src="/umeditor/lang/zh-cn/zh-cn.js"></script>
    <script>
        //deploy the editor
        var content = UM.getEditor('myEditor');
    </script>
@append