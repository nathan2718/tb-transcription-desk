<?php

# 0. STANDARD SETTINGS USED IN TRANSCRIBE BENTHAM

$wgSitename         = "My Transcription Desk";
$wgServerName 	    = "www.my.domain";
$wgServer	    = "http://www.my.domain";

#v The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs please see:
## http://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath       = "/td";
$wgScriptExtension  = ".php";

$wgEnableEmail      = true;
$wgEnableUserEmail  = true; # UPO

$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

$wgEnableUploads       = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

$wgLanguageCode = "en";

$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";


#1. ENABLING PRETTY URLS (N.B HTACCESS ALSO USED
$wgArticlePath = "$wgScriptPath/$1"; 
$wgUsePathInfo = true;        # Enable use of pretty URLs


#2. SKIN SETTINGS. ALL OTHERS HAVE BEEN REMOVED!
$wgDefaultSkin = 'benthammodern';


#3. USER PERMISSIONS
# Disable for everyone.
$wgGroupPermissions['*']['edit']              = false;
# Disable for users, too: by default 'user' is allowed to edit, even if '*' is not.
$wgGroupPermissions['user']['edit']           = false;
# Make it so users with confirmed e-mail addresses are in the group.
$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;
# Hide group from user list. 
$wgImplicitGroups[] = 'emailconfirmed';
# Finally, set it to true for the desired group.
$wgGroupPermissions['emailconfirmed']['edit'] = true;


#4. FAVICON
$wgFavicon = "$wgScriptPath/favicon.ico";


#5. EXTENSIONS
require_once("$IP/extensions/Progressbar.php");
require_once("$IP/extensions/videoflash.php");


#6. PROTECT NAMESPACES FROM EDITING
$wgGroupPermissions['*']['edittype'] = false;
$wgGroupPermissions['sysop']['edittype'] = true;
$wgNamespaceProtection[NS_HELP] = array('edithelp');
$wgNamespacesWithSubpages[NS_HELP] = true;
$wgGroupPermissions['*']['edithelp'] = false;
$wgGroupPermissions['sysop']['edithelp'] = true;
$wgGroupPermissions['user']['upload']           = true;


#7. TURN OFF SECTION EDITING
#$wgDefaultUserOptions ['editsection'] = false;
#(Achieved this by editing MediaWiki:Common.css page in wiki)


#8. MORE ON NAMESPACE EXTENSIONS AND SEARCH SETTINGS
define("NS_METADATA", 100);
define("NS_METADATA_TALK", 101);
$wgExtraNamespaces[NS_METADATA] = "Metadata";
$wgExtraNamespaces[NS_METADATA_TALK] = "Metadata_talk";
 $wgNamespaceProtection[NS_METADATA] = array( 'editmetadata' ); #permission "editmetaata" required to edit the Metadata namespace
$wgGroupPermissions['sysop']['editmetadata'] = true;      #permission "editmetadata" granted to users in the "sysop" group
#Set default searching
$wgNamespacesToBeSearchedDefault = array(
	NS_MAIN =>           true,
	NS_TALK =>           false,
	NS_USER =>           false,
	NS_USER_TALK =>      false,
	NS_PROJECT =>      false,
	NS_PROJECT_TALK => false,
	NS_IMAGE =>          false,
	NS_IMAGE_TALK =>     false,
	NS_MEDIAWIKI =>      false,
	NS_MEDIAWIKI_TALK => false,
	NS_TEMPLATE =>       false,
	NS_TEMPLATE_TALK =>  false,
	NS_HELP =>           false,
	NS_HELP_TALK =>      false,
	NS_CATEGORY =>       false,
	NS_CATEGORY_TALK =>  false,
        NS_METADATA => true,
        NS_METADATA_TALK => false
);

$wgNamespaceProtection[NS_HELP] = array('edithelp');
$wgNamespacesWithSubpages[NS_HELP] = true;
$wgGroupPermissions['*']['edithelp'] = false;
$wgGroupPermissions['sysop']['edithelp'] = true;


#9. SOMETHING TO DO WITH MAGIC WORDS. FORGET WHAT THIS WAS FOR

$wgCustomVariables = array('CURRENTUSER','LOGO');
 
$wgHooks['MagicWordMagicWords'][]          = 'wfAddCustomVariable';
$wgHooks['MagicWordwgVariableIDs'][]       = 'wfAddCustomVariableID';
$wgHooks['LanguageGetMagic'][]             = 'wfAddCustomVariableLang';
$wgHooks['ParserGetVariableValueSwitch'][] = 'wfGetCustomVariable';
 
function wfAddCustomVariable(&$magicWords) {
	foreach($GLOBALS['wgCustomVariables'] as $var) $magicWords[] = "MAG_$var";
	return true;
	}
 
function wfAddCustomVariableID(&$variables) {
	foreach($GLOBALS['wgCustomVariables'] as $var) $variables[] = constant("MAG_$var");
	return true;
	}
 
function wfAddCustomVariableLang(&$langMagic, $langCode = 0) {
	foreach($GLOBALS['wgCustomVariables'] as $var) {
		$magic = "MAG_$var";
		$langMagic[defined($magic) ? constant($magic) : $magic] = array(0,$var);
		}
	return true;
	}
 
function wfGetCustomVariable(&$parser,&$cache,&$index,&$ret) {
	switch ($index) { 
		case MAG_CURRENTUSER:
			$parser->disableCache(); # Mark this content as uncacheable
			$ret = $GLOBALS['wgUser']->mName;
			break;
 
		case MAG_LOGO:
			$ret = $GLOBALS['wgLogo'];
			break;
 
		}
	return true;
	}

	
#10. MORE EXTENSIONS
require_once( "$IP/extensions/awc/forums/awc_forum.php" );
include("extensions/notitle.php");
include("extensions/RSSReader/RSSReader.php");
require_once("$IP/extensions/DiscussionThreading/DiscussionThreading.php");
require_once( "extensions/recaptcha/ReCaptcha.php" );
$recaptcha_public_key = 'ADD KEY HERE';
$recaptcha_private_key = 'ADD KEY HERE';
include_once("$IP/extensions/SemanticMediaWiki/includes/SMW_Settings.php");
enableSemantics('transcribe-bentham.da.ulcc.ac.uk');
$wgNamespaceProtection[104] = array('edittype');
$wgNamespacesWithSubpages[104] = true;
$wgGroupPermissions['*']['edittype'] = false;
$wgGroupPermissions['sysop']['edittype'] = true;

$wgNamespaceProtection[102] = array('editproperty');
$wgNamespacesWithSubpages[102] = true;
$wgGroupPermissions['*']['editproperty'] = false;
$wgGroupPermissions['sysop']['editproperty'] = true;


require_once("$IP/extensions/SocialProfile/SocialProfile.php");
require_once("$IP/extensions/SocialProfile/UserStats/EditCount.php");

$wgExtraNamespaces[NS_USER_PROFILE] = 'User_profile';
$wgExtraNamespaces[NS_USER_WIKI] = 'UserWiki';
$wgUserProfileDisplay['stats'] = true;
$wgUserProfileDisplay['friends'] = true;
$wgUserProfileDisplay['foes'] = false;
$wgUserProfileDisplay['gifts'] = true;
$wgUserBoard = true;
$wgUserProfileDisplay['board'] = true;
$wgUserStatsPointValues['comment'] = 10; // Points awarded for comments
$wgUserStatsPointValues['edit'] = 25; // Points awarded for editing a page
$wgUserStatsPointValues['friend'] = 100; // Points awarded for adding a friend
$wgUserStatsPointValues['user_image'] = 1000; // Points awarded for avatar

$wgUserLevels = array(

'Probationer' => 0,
'Novice' => 2500,
'Apprentice' => 5000,
'Scribe' => 10000,
'Amanuensis' => 15000,
'Acolyte' => 20000,
'Adept' => 25000,
'Expert' => 40000,
'Master' => 60000,
'Prodigy' => 75000,
);

# $wgGroupPermissions['sysop']['updatepoints'] = true;

require_once("$IP/extensions/JBZV/JBZV.php");
require_once("$IP/extensions/TEITags.php");
require_once("$IP/extensions/JBTEIToolbar/JBTEIToolbar.php");
require_once("$IP/extensions/GroupPermissionsManager/GroupPermissionsManager.php");

#UserMerge/delete extension
require_once( "$IP/extensions/UserMerge/UserMerge.php" );
require_once( "$IP/extensions/videoflash.php" );
$wgGroupPermissions['bureaucrat']['usermerge'] = true;
#optional - default is array( 'sysop' )
$wgUserMergeProtectedGroups = array( 'sysop' );
$wgFavicon = "$wgScriptPath/favicon.ico";
$wgFileExtensions[] = 'svg';
$wgShowIPinHeader= false;
$wgAllowExternalImages = true;
$wgShowExceptionDetails = true;

include_once("$IP/extensions/MassEditRegex/MassEditRegex.php");


#12. Other settings
$wgExternalLinkTarget = '_blank';

#$wgCacheEpoch = "20110119130808";
?>