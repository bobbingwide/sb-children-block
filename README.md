# SB Children block 
![banner](https://raw.githubusercontent.com/bobbingwide/sb-children-block/master/assets/sb-children-block-banner-772x250.jpg)
* Contributors:      bobbingwide
* Tags:              block, children, links
* Requires at least: 5.4.2
* Tested up to:      5.4.2
* Stable tag:        0.5.2
* Requires PHP:      7.2.0
* License:           GPL-2.0-or-later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html

List children of the current content as links.

## Description 
Use the Children block ( sb/children-block ) to list children of the current content as links.
Works for any hierarchical post type which supports page-attributes, such as page.

## Installation 

1. Upload the plugin files to the `/wp-content/plugins/sb-children-block` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

## Frequently Asked Questions 

# What are the values for the depth parameter? 

- Value - Meaning
- 0 - Display all descendents in a tree
- 1 - Display Children only
- 2 - Display Children and Grandchildren
- n - Display n levels of descendents
- -1 - Display all descendents in a single list

## Screenshots 
1. Children block depth=0
2. Children block depth=1
3. Children block depth=-1

## Upgrade Notice 
# 0.5.2 
Upgrade for a little help on the Depth attribute.
* Note: The plugin is delivered with the Development build.
# 0.5.1 
Upgrade for latest build.

# 0.5.0 
Now internationalised.

# 0.4.0 
Renamed from children-block to sb-children-block in preparation for delivery from wordpress.org as a Single Block ( SB ) plugin.
Removed parent block to sb-parent-block.

# 0.3.2 
Upgrade for some improved usage notes.

# 0.3.1 
Upgrade for some usage notes.

# 0.3.0 
Use the Parent block in child pages to link back to the parent page.

# 0.2.0 
Now implements the child list using server side rendering and supports the depth parameter

# 0.1.0 
Initial version generated by npm wp-create-block

## Changelog 
# 0.5.2 
* Changed: Added help parameter for Depth attribute, https://github.com/bobbingwide/sb-chidren-block/issues/7
* Changed: Built with `npm start`
* Changed: Updated language files

# 0.5.1 
* Changed: Update build files
* Changed: Update language files

# 0.5.0 
* Changed: Internationalized and localized, https://github.com/bobbingwide/sb-children-block/issues/5
* Deleted: Removed sb-parent-block, https://github.com/bobbingwide/sb-children/block/issues/4
* Tested: With WordPress 5.4.2 and WordPress Multi Site
* Tested: With WordPress 5.5
* Tested: With PHP 7.3 and PHP 7.4

# 0.4.0 
* Rename block from oik/children-block to sb/children-block https://github.com/bobbingwide/sb-children-block/issues/4

# 0.3.3 
* Changed: More tweaks to the readme. - not released

# 0.3.2 
* Changed: Attempted to improve usage notes in the readme.

# 0.3.1 
* Changed: Add screenshots, banner and update the readme.

# 0.3.0 
* Added: Parent block https://github.com/bobbingwide/children-block/issues/3
* Changed: Prepare for multiple blocks https://github.com/bobbingwide/children-block/issues/2
* Tested: With WordPress 5.4.2 and WordPress Multi Site
* Tested: With PHP 7.3 and PHP 7.4

# 0.2.0 
* Changed: Now implements the child list using server side rendering and supports the depth= parameter https://github.com/bobbingwide/children-block/issues/1

# 0.1.0 
* First version as generated by `npm wp-create-block`

## Build process 
Only necessary if you want to build the block yourself.

- To build the block during development.

`npm start` or `npm run dev`

Press Ctrl-C to to stop process.

- To build the block for runtime.

`npm run build`

The routine should terminate when the build is complete.

- To build the main file for translation

`npm run makepot`

- To create the block editor language files after translation

`npm run makejson`


Pre-requisite:

You need to have `npm` - Node Package Manager - installed.

For some basic instructions see the [oik-blocks summary of blocks README](https://github.com/bobbingwide/oik-blocks/tree/master/blocks)

Most people run the `npm` command from the command line.


