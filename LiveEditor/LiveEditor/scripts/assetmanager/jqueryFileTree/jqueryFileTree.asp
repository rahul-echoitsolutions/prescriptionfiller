<%

'
' jQuery File Tree ASP (VBS) Connector
' Copyright 2008 Chazzuka
' programmer@chazzuka.com
' http://www.chazzuka.com/
'

Session.CodePage = 65001

Function Encode_UTF8(astr)
	Dim c 
	Dim utftext 
	utftext = ""
	If isNull(astr) = false or astr <> "" Then
	  astr = Replace(astr, "'", "'") 'replacing the apostrophe
	  astr = Replace(astr, "–", "-") 'replacing the emdash with minus sign
	  For n = 1 To Len(astr)
		c = Asc(Mid(astr, n, 1))
		If c < 128 Then
		  utftext = utftext + Mid(astr, n, 1)
		ElseIf ((c > 127) And (c < 2048)) Then
		  utftext = utftext + Chr(((c \ 64) Or 192))
		  utftext = utftext + Chr(((c And 63) Or 128))
		Else
		  utftext = utftext + Chr(((c \ 144) Or 234))
		  utftext = utftext + Chr((((c \ 64) And 63) Or 128))
		  utftext = utftext + Chr(((c And 63) Or 128))
		End If
	  Next
	End If
	Encode_UTF8 = utftext
End Function
Function URLDecode(str)
	str = Replace(str, "+", " ")
	For i = 1 To Len(str)
		sT = Mid(str, i, 1)
		If sT = "%" Then
			If i+2 < Len(str) Then
				sR = sR & _
					Chr(CLng("&H" & Mid(str, i+1, 2)))
				i = i+2
			End If
		Else
			sR = sR & sT
		End If
	Next
	URLDecode = sR
End Function

' retrive base directory
dim BaseFileDir:BaseFileDir=Encode_UTF8(Request.Form("dir"))
' if blank give default value
if len(BaseFileDir)=0 then BaseFileDir="/userfiles/"

dim IsImg:IsImg=false
if(Request.QueryString("img")="yes") then
	IsImg = true
end if


dim ObjFSO,BaseFile,Html
' resolve the absolute path
BaseFile = Server.MapPath(BaseFileDir)&"\"
' create FSO
Set ObjFSO = Server.CreateObject("Scripting.FileSystemObject")
' if given folder is exists
if ObjFSO.FolderExists(BaseFile) then
       dim ObjFolder,ObjSubFolder,ObjFile,i__Name,i__Ext
       Html = Html +  "<ul class=""jqueryFileTree"" style=""display: none;"">"&VBCRLF
       Set ObjFolder = ObjFSO.GetFolder(BaseFile)
       ' LOOP THROUGH SUBFOLDER
       For Each ObjSubFolder In ObjFolder.SubFolders
               i__Name=ObjSubFolder.name
               Html = Html + "<li class=""directory collapsed"">"&_
                                         "<a href=""#"" rel="""+(BaseFileDir+i__Name+"/")+""">"&_
                                         (i__Name)+"</a></li>"&VBCRLF
       Next
       'LOOP THROUGH FILES
       For Each ObjFile In ObjFolder.Files
               ' name
               i__Name=ObjFile.name
               ' extension
               i__Ext = LCase(Mid(i__Name, InStrRev(i__Name, ".", -1, 1) + 1))
               if (IsImg=false or (IsImg=true and (i__Ext="jpeg" or i__Ext="jpg" or i__Ext="png" or i__Ext="gif"))) then
				   Html = Html + "<li class=""file ext_"&i__Ext&""">"&_
											 "<a href=""#"" rel="""+(BaseFileDir+i__Name)+""">"&_
											 (i__name)+"</a></li>"&VBCRLF
               end if
       Next
       Html = Html +  "</ul>"&VBCRLF
end if

Response.Write Html
%>
