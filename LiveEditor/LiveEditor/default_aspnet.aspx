<%@ Page Language="vb" ValidateRequest="false" Debug="true" %>
<%@ Register TagPrefix="editor" Assembly="WYSIWYGEditor" namespace="InnovaStudio" %>

<script language="VB" runat="server">
    Sub Page_Load(Source As Object, E As EventArgs)
        
        If Not Page.IsPostBack Then
            oEdit1.Text = "<p>First Paragraph here. Lorem ipsum fierent mnesarchum ne vel, et usu posse takimata omittantur, pro ut tale erant sapientem. Et regione tibique ancillae nam. Tale modus iuvaret eu usu.</p>"
        End If
   
        'Editor Dimension
        oEdit1.Width = 850
        oEdit1.Height = 350
        
        'Add Custom Buttons
        oEdit1.ToolbarCustomButtons.Add(New CustomButton("MyCustomButton", "alert('Run custom command..')", "Caption here", "btnCustom1.gif"))

        'Toolbar Buttons Configuration
        Dim tabHome As InnovaStudio.ISTab
        Dim grpEdit1 As InnovaStudio.ISGroup = New InnovaStudio.ISGroup("grpEdit1", "", New String() {"Bold", "Italic", "Underline", "FontDialog", "ForeColor", "TextDialog", "RemoveFormat"})
        Dim grpEdit2 As InnovaStudio.ISGroup = New InnovaStudio.ISGroup("grpEdit2", "", New String() {"Bullets", "Numbering", "JustifyLeft", "JustifyCenter", "JustifyRight"})
        Dim grpEdit3 As InnovaStudio.ISGroup = New InnovaStudio.ISGroup("grpEdit3", "", New String() {"LinkDialog", "ImageDialog", "YoutubeDialog", "TableDialog", "Emoticons"})
        Dim grpEdit4 As InnovaStudio.ISGroup = New InnovaStudio.ISGroup("grpEdit4", "", New String() {"InternalLink", "CustomObject", "MyCustomButton", "CustomTag"})
        Dim grpEdit5 As InnovaStudio.ISGroup = New InnovaStudio.ISGroup("grpEdit5", "", New String() {"Undo", "Redo", "FullScreen", "SourceDialog"})
        tabHome = New InnovaStudio.ISTab("tabHome", "Home")
        tabHome.Groups.AddRange(New InnovaStudio.ISGroup() {grpEdit1, grpEdit2, grpEdit3, grpEdit4, grpEdit5})
        oEdit1.ToolbarTabs.Add(tabHome)
        
        'Define "InternalLink" & "CustomObject" buttons
        oEdit1.InternalLink = "my_custom_dialog.htm"
        oEdit1.InternalLinkWidth = 650
        oEdit1.InternalLinkHeight = 350
        oEdit1.CustomObject = "my_custom_dialog.htm"
        oEdit1.CustomObjectWidth = 650
        oEdit1.CustomObjectHeight = 350
        
        'Enable Custom File Browser
        oEdit1.fileBrowser = "/liveeditor/assetmanager/asset.aspx"
        
        'Apply stylesheet for the editing content
        oEdit1.Css = "styles/default.css"
                
        'Define "CustomTag" dropdown
        oEdit1.CustomTags.add(new Param("First Name","{%first_name%}"))
        oEdit1.CustomTags.add(new Param("Last Name","{%last_name%}"))
        oEdit1.CustomTags.Add(New Param("Email", "{%email%}"))
        
        'Editing mode
        'oEdit1.EditMode = EditorModeEnum.XHTML
    End Sub

    Sub Button1_Click(Source As System.Object, E As System.EventArgs)
        'Label1.Text = "<div style=""padding:0px 20px;border:#000000 1px dashed;"">" & oEdit1.Text & "</div>"
        Label1.Text = oEdit1.Text
    End Sub
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link href="styles/default.css" rel="stylesheet" type="text/css" />

    <script src="scripts/common/jquery-1.7.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js" type="text/javascript"></script>
    <script src="scripts/common/webfont.js" type="text/javascript"></script>

    <script src="scripts/common/fancybox13/jquery.easing-1.3.pack.js" type="text/javascript"></script>
    <script src="scripts/common/fancybox13/jquery.mousewheel-3.0.2.pack.js" type="text/javascript"></script>
    <script src="scripts/common/fancybox13/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
    <link href="scripts/common/fancybox13/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $('a[rel=lightbox]').fancybox();
        });
    </script>

    <style type="text/css">
        body{font:12px verdana,arial,sans-serif;background-image:url(styles/45degreee_fabric.png);line-height:23px;}
        a{color:#0000cc;font-size:12px;}
        .button {padding:10px 30px 10px 30px;    
            margin-left:2px;    
            font-size:11px;font-weight:bold;color:#000000;
            background:url('scripts/style/button.png') #EEEEEE;    
            border-top:1px solid #DDDDDD;
            border-right:1px solid #AAAAAA;
            border-bottom:1px solid #AAAAAA;
            border-left:1px solid #DDDDDD;       
            cursor:pointer;}        
        h1, h2, h3 {margin-top:40px;margin-bottom:20px;text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.8);}
        h2 {text-transform:uppercase}
        h3 {font-size:14px;color:#a90000;border-bottom:#000000 1px dotted;}
    </style>

</head>
<body style="margin:50px;margin-top:20px">
   
<form id="Form1" method="post" runat="server">

<p style="border:#000000 1px dashed;padding:10px;width:500px;margin-bottom:30px"><a href="default.htm">BACK</a></p>

<h1 style="font-family:Bevan;font-size:24pt;color: rgb(191, 0, 0);">InnovaStudio Live Editor - ASP.NET Example</h1>

<div id="preview" style="width:850px;">
    <asp:label id="Label1" runat="server"/>
</div>
<div style="clear:both;"></div>
<br />

<editor:wysiwygeditor 
    Runat="server"
    scriptPath="scripts/"
    ID="oEdit1" />
<br />  
<asp:button runat="server" CssClass="button" onclick="Button1_Click" Text="SUBMIT" ID="btnSubmit" />


<br />
<hr />
<div style="font-size:11px">Copyright © 2012, INNOVASTUDIO (www.InnovaStudio.com). All rights reserved.</div>


</form>

</body>
</html>