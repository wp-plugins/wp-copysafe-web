<!-- hide JavaScript from non-JavaScript browsers

	//  WP Copysafe Web - Version 4.7.1.0
	//  Copyright (c) 1998-2013 ArtistScope. All Rights Reserved.
	//  www.artistscope.com
	//
	// The Copysafe Plugin is supported across all Windows since XP
	//
	// Special JS version for Wordpress

// Debugging outputs the generated html into a textbox instead of rendering
//	option has been moved to wp-copysafe-web.php

// REDIRECTS

var m_szLocation = document.location.href.replace(/&/g,'%26');	
var m_szDownloadNo = wpcsw_plugin_url + "download_no.html";
var m_szDownloadIE = wpcsw_plugin_url + "download_ie.html?ref=" + m_szLocation;
var m_szDownloadFX = wpcsw_plugin_url + "download_fx.html?ref=" + m_szLocation;

//====================================================
//   Current version == 4.7.1.0
//====================================================

var m_nV1=4;
var m_nV2=7;
var m_nV3=1;
var m_nV4=0;

//===========================
//   DO NOT EDIT BELOW 
//===========================

var m_szAgent = navigator.userAgent.toLowerCase();
var m_szBrowserName = navigator.appName.toLowerCase();
var m_szPlatform = navigator.platform.toLowerCase();
var m_bNetscape = false;
var m_bMicrosoft = false;
var m_szPlugin = "";

var m_bWin64 = ((m_szPlatform == "win64") || (m_szPlatform.indexOf("win64")!=-1) || (m_szAgent.indexOf("win64")!=-1));
var m_bWin32 = ((m_szPlatform == "win32") || (m_szPlatform.indexOf("win32")!=-1));
var m_bWin2k = ((m_szAgent.indexOf("windows nt 5.0")!=-1) || (m_szAgent.indexOf("windows 2000")!=-1));
var m_bWinxp = ((m_szAgent.indexOf("windows nt 5.1")!=-1) || (m_szAgent.indexOf("windows xp")!=-1));
var m_bWin2k3 = (m_szAgent.indexOf("windows nt 5.2")!=-1);	
var m_bVista = (m_szAgent.indexOf("windows nt 6.0")!=-1);
var m_bWindows7 = (m_szAgent.indexOf("windows nt 6.1")!=-1);
var m_bWindows8 = (m_szAgent.indexOf("windows nt 6.2")!=-1);
var m_bWindows = (((m_bWin2k) || (m_bWinxp) || (m_bWin2k3) || (m_bVista) || (m_bWindows7) || (m_bWindows8)) && ((m_bWin32) || (m_bWin64)));

var m_bOpera = ((m_szAgent.indexOf("opera")!=-1) && !!(window.opera && window.opera.version) && (m_bpOpera));
var m_bFx3 = ((m_szAgent.indexOf("firefox/3")!=-1) && (m_szAgent.indexOf("flock")==-1) && (m_szAgent.indexOf("navigator")==-1));
var m_bFx4 = ((m_szAgent.indexOf("firefox/4")!=-1) && (m_szAgent.indexOf("flock")==-1) && (m_szAgent.indexOf("navigator")==-1));
var m_bFirefox = ((m_szAgent.indexOf("firefox")!=-1) && testCSS("MozBoxSizing") && (!(m_bFx3)) && (!(m_bFx4)) && (m_bpFx));
var m_bSafari = ((m_szAgent.indexOf("safari")!=-1) && Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0 && (m_bpSafari));
var m_bChrome = ((m_szAgent.indexOf("chrome")!=-1) && !!(window.chrome && chrome.webstore && chrome.webstore.install) && (m_bpChrome));
var m_bNav = ((m_szAgent.indexOf("navigator")!=-1) && (m_bpNav));

var m_bNetscape = ((m_bChrome) || (m_bFirefox) || (m_bNav) || (m_bOpera) || (m_bSafari));
var m_bMicrosoft = ((m_szAgent.indexOf("msie")!=-1) && (/*@cc_on!@*/false || testCSS("msTransform")) && (m_bpMSIE)); 

function testCSS(prop) {
    return prop in document.documentElement.style;
}

if (m_bpDebugging == true)
	{
//	document.write("UserAgent= " + m_szAgent + "<br>");
//	document.write("Browser= " + m_szBrowserName + "<br>");
//	document.write("Platform= " + m_szPlatform + "<br>");
//	document.write("Referer= " + m_szLocation + "<br>");
    }

function CopysafeVersionCheck()
	{
		var v = typeof document.getElementById != "undefined" && typeof document.getElementsByTagName != "undefined" && typeof document.createElement != "undefined";
		var AC = [0,0,0];
		var x = "";
		
        if (typeof navigator.plugins != "undefined" && navigator.plugins.length > 0)
        {
	        // Navigator, firefox, mozilla

		navigator.plugins.refresh(false);

		var szDescription = "ArtistScope Plugin 5";
		var szVersionMatch = "Plugin 5 v";

		if (typeof navigator.plugins[szDescription] == "object")
	        {
	            x = navigator.plugins[szDescription].description;
	            ix = x.indexOf(szVersionMatch);
	            if (ix > -1)
	            	x = x.slice(ix + szVersionMatch.length);
	            else
	            	x = "";
	        }
		}
		else if (typeof window.ActiveXObject != "undefined")
		{
			// Internet explorer

			var y = null;

			try
			{
				y = new ActiveXObject("ARTISTSCOPE.ArtistScopeCtrl")
                x = y.GetVersion();
			}
			catch(t)
			{
			}
		}

		if (x.length > 0)
		{
           	ix1 = x.indexOf(".");
           	ix2 = x.indexOf(".", ix1 + 1);
	            	
           	if (ix1 != -1 && ix2 != -1)
           	{
            	AC[0] = parseInt(x.slice(0, ix1));
            	AC[1] = parseInt(x.slice(ix1 + 1, ix2));
            	AC[2] = parseInt(x.slice(ix2 + 1));
           	}
		}

        return AC;
	}

var arVersion = CopysafeVersionCheck();
var szNumeric = "" + arVersion[0] + "." + arVersion[1] + "." + arVersion[2];
	

if ((m_bWindows) && (m_bMicrosoft))
	{
	m_szPlugin = "OCX";
	if ((arVersion[0] < m_nV1) || (arVersion[0] == m_nV1 && arVersion[1] < m_nV2) || (arVersion[0] == m_nV1 && arVersion[1] == m_nV2 && arVersion[2] < m_nV3))
		{
		window.location=unescape(m_szDownloadIE);
		document.MM_returnValue=false;
		}
	}
else if ((m_bWindows) && (m_bNetscape))
	{
	m_szPlugin = "DLL";
	if ((arVersion[0] < m_nV1) || (arVersion[0] == m_nV1 && arVersion[1] < m_nV2) || (arVersion[0] == m_nV1 && arVersion[1] == m_nV2 && arVersion[2] < m_nV3))
		{
		window.location=unescape(m_szDownloadFX);
		document.MM_returnValue=false;
		}
	}
else 
	{
	window.location=unescape(m_szDownloadNo);
	document.MM_returnValue=false;
	}


function bool2String(bValue)
{
	if (bValue == true) {
		return "1";
	}
	else {
		return "0";
	}
}

function paramValue(szValue, szDefault)
{
	if (szValue.toString().length > 0) {
		return szValue;
	}
	else {
		return szDefault;
	}
}

function expandNumber(nValue, nLength)
{
    var szValue = nValue.toString();
    while(szValue.length < nLength)
        szValue = "0" + szValue;
    return szValue;
}


// The copysafe-insert functions

function insertCopysafeWeb(szImageName, szcWidth, szcHeight)
{
    // Extract the image width and height from the image name (example name: zulu580_0580_0386_C.class)

    var nIndex = szImageName.lastIndexOf('_C.');
    if (nIndex == -1)
    {
        // Strange filename that doesn't conform to the copysafe standard. Can't render it.
        return;
    }

	if (!szcWidth) {
    var szWidth = szImageName.substring(nIndex - 9, nIndex - 5);
	} else {
		var szWidth = szcWidth;
	}
	if (!szcHeight) {
    var szHeight = szImageName.substring(nIndex - 4, nIndex);
	} else {
		var szHeight = szcHeight;
	}

    var nWidth = szWidth * 1;
    var nHeight = szHeight * 1;

	alert(nWidth + " " + nHeight);

    // Expand width and height to allow for border

    var nBorder = m_szDefaultBorder * 1;
    nWidth = nWidth + (nBorder * 2);
    nHeight = nHeight + (nBorder * 2);

    insertCopysafeImage(nWidth, nHeight, "", "", nBorder, "", "", "", [szImageName]);
}

function insertCopysafeImage(nWidth, nHeight, szTextColor, szBorderColor, nBorder, szLoading, szLink, szTargetFrame, arFrames)
{
    
	if (m_bpDebugging == true)
        { 
        document.writeln("<textarea rows='27' cols='80'>"); 
        } 

    if ((m_szPlugin == "DLL") || (m_szPlugin == "OCX"))
    {
    var szObjectInsert = "";
    
    if (m_szPlugin == "DLL")
    {      
    	szObjectInsert = "type='application/x-artistscope-firefox5' codebase='" + wpcsw_plugin_url + "download_fx.php' ";
        document.writeln("<ob" + "ject " + szObjectInsert + " width='" + nWidth + "' height='" + nHeight + "'>");
        if (m_bpProtectionLayer) {
        document.writeln("<param name='ProtectionActivated' value='OnProtectionActivated()' />");
	 }
    }
    else if (m_szPlugin == "OCX")
    {
        szObjectInsert = "classid='CLSID:46C73251-78A3-43C8-BA64-A18B29314D69'";
        document.writeln("<ob" + "ject id='CopysafeObject' " + szObjectInsert + " width='" + nWidth + "' height='" + nHeight + "'>");
    }


    document.writeln("<param name='KeySafe' value='" + bool2String(m_bpKeySafe) + "' />");
    document.writeln("<param name='CaptureSafe' value='" + bool2String(m_bpCaptureSafe) + "' />");
    document.writeln("<param name='MenuSafe' value='" + bool2String(m_bpMenuSafe) + "' />");
    document.writeln("<param name='RemoteSafe' value='" + bool2String(m_bpRemoteSafe) + "' />");
    
    document.writeln("<param name='Style' value='ImageLink' />");
    document.writeln("<param name='TextColor' value='" + paramValue(szTextColor, m_szDefaultTextColor) + "' />");
    document.writeln("<param name='BorderColor' value='" + paramValue(szBorderColor, m_szDefaultBorderColor) + "' />");
    document.writeln("<param name='Border' value='" + paramValue(nBorder, m_szDefaultBorder) + "' />");
    document.writeln("<param name='Loading' value='" + paramValue(szLoading, m_szDefaultLoading) + "' />");
    document.writeln("<param name='Label' value='' />");
    document.writeln("<param name='Link' value='" + paramValue(szLink, m_szDefaultLink) + "' />");
    document.writeln("<param name='TargetFrame' value='" + paramValue(szTargetFrame, m_szDefaultTargetFrame) + "' />");
    document.writeln("<param name='Message' value='' />");   
    document.writeln("<param name='FrameDelay' value='2000' />");
    document.writeln("<param name='FrameCount' value='1' />");
    document.writeln("<param name='Frame000' value='" + m_szImageFolder + m_szClassName + "' />");

    document.writeln("</ob" + "ject />"); 

    if (m_bpDebugging == true)
		{
			document.writeln("</textarea />");
		}
    }
}
// -->
