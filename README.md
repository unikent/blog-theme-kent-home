# Kent Blogs Home Theme

A new responsive, on-brand theme for the root blog of blog.kent.ac.uk

## Installing

Download and install to the your themes folder within wp-content.

**This is a child theme of the [Kent Blog Theme](https://github.com/unikent/blog-theme-kent) and so you will need to install that too.**

To install via composer see [composer installers](https://github.com/composer/installers) and add the following lines to your composer.json

```

	{
	   "repositories": [
		 { 
           "type":"package",
           "package": {
             "name": "unikent/blog-theme-kent-home",
             "type": "wordpress-theme",
             "version":"master",
             "source": {
                 "url": "https://github.com/unikent/blog-theme-kent-home",
                 "type": "git",
                 "reference":"master"
               }
           }
         },
         { 
            "type":"package",
            "package": {
              "name": "unikent/blog-theme-kent",
              "type": "wordpress-theme",
              "version":"master",
              "source": {
                  "url": "https://github.com/unikent/blog-theme-kent",
                  "type": "git",
                  "reference":"master"
                }
            }
          }
	   ],
	   "require":{
	    "unikent/blog-theme-kent":"dev-master",
	    "unikent/blog-theme-kent-home":"dev-master"
	   }
	}
   
```


## Developing

The theme will load compressed and minified JS, and compiled minified CSS by default.

To load prettier development versions instead set the `WP_ENV` php constant to *development* or *local*.

This is best done in your wp-config.php file

**This is done for you automagically on blogs-test.ac.uk**


## Creating A Build

The theme assets are pre-built however there is a grunt task to rebuild if developing.

1. Install Node.js - this includes npm by default.

2. Install Grunt globally - its quite useful! `npm install -g grunt` or `npm install -g grunt-cli` for the cli version. 

4. Install the dependencies of our Grunt task - `npm install` from the themes directory.

3. Run Grunt - `grunt dev` from the theme root for development assets, or `grunt build` for production.


## Customising

See [parent theme](https://github.com/unikent/blog-theme-kent).

## Page Templates

This theme provides two page templates:

### Search Results

This page template will render results from a google cse instance targeting blogs.kent.ac.uk.

**This template is designed to be used with the page slug `/search/`**

The query parameter for search is `q`. The theme's search form template has been adapted to use this, and to target the url `/search/`, and can be retrieved with the standard `get_search_form()`

### Blogs List

This page template will render a Datatable list of all blogs in the multisite network.