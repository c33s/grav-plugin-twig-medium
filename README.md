# Twig Medium Plugin

This plugin allows to access Media from Grav Streams in twig.

The **Twig Medium** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Provides the ability to create a medium object from a file/stream in twig

## Installation

Installing the Twig Medium plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install twig-medium

This will install the Twig Medium plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/twig-medium`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `twig-medium`. You can find these files on [GitHub](https://github.com/c33s/grav-plugin-twig-medium) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/twig-medium
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/twig-medium/twig-medium.yaml` to `user/config/plugins/twig-medium.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

## Usage

If you prefer to put some of your shared media/images in `user/images` you can define a stream like the following:

user/config/streams.yaml
```
schemes:
  image:
    type: ReadOnlyStream
    paths:
      - user://images
      - system://images
      - user://pages/images
```

and then access `user/images/logo.png` like this in twig:

```
{{ medium('image://logo.png').resize(35, 35).html('', '', 'logo') }}

```
which results in
```
<img class="logo" src="/images/1/6/3/c/c/163cc4f82d012f1a743875fe9ce1f9ddfba448a2-logo.png">
```

more examples:

favicon
```
<link rel="icon" type="image/png" href="{{ url('image://favicon.ico') }}" />
```

generate multi sized touch icons:
```
{% set logo = medium('image://logo.png') %}
{% for size in apple_touch_icon_sizes %}
<link rel="apple-touch-icon" sizes="{{ size ~ 'x' ~ size }}" href="{{ logo.resize(size, size).url() }}">
{% endfor %}
```