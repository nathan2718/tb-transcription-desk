# Installation instructions #

First install Mediawiki.

The TB Transcription Desl comprises three Mediawiki extensions: JBTEIToolbar and TEITags (supporting TEI markup) and JBZV (the Zoom Viewer support).

Download all files and directories from the [source repository](http://code.google.com/p/tb-transcription-desk/source/browse/#svn%2Ftrunk%2Ftd) and and copy them to the Mediawiki extensions directory

To the end of your MediaWiki LocalSettings.php file, add

```
require_once("$IP/extensions/JBZV/JBZV.php");
require_once("$IP/extensions/TEITags.php");
require_once("$IP/extensions/JBTEIToolbar/JBTEIToolbar.php");
```

An example of the LocalSettings.php changes is in the accompanying file.

To support the Zoom viewer, images need to be tiled and stored in a directory "Zimages" in the Mediawiki directory. The tiles can be created with the Zoomify tools or with the [Perl Slice script](http://www.zoomify.com/downloads/products/development/PERL-slice.zip). The directory names for each image's tiles need to match the name of the page where the image is to appear (e.g. page "JB/001/001/001" uses images from "/td/Zimages/001\_001\_001") from Zoomfy. (I created a wrapper script to run the Perl Slice script over a directory of images.) The exact pagename/filename algorithm can be changed in the JBZV script.

A copy of the Transcribe Bentham theme is included. It is based on the Modern theme that ships with MedaWiki.

# Other Mediawiki Extensions used in Transcribe Bentham #

(Some of these are more optional than others.)

  * ProgressBar
  * VideoFlash
  * AWC Forum (optional)
  * Notitle
  * RSSReader
  * DiscussionThreading
  * ReCaptcha
  * SemanticMediaWiki (optional)
  * SocialProfile
  * GroupPermissionsManager
  * UserMerge
  * MassEditRegex


# License and warranty #

The code included here is licensed under the same open GPL as MediaWiki.

No warranty is made that it will function correctly, or that it won't fill up your web server log with PHP errors and warnings.

I am happy to add new committers to the project if anyone wants to develop it further and better.