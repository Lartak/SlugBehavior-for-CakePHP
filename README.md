SlugBehavior-for-CakePHP
========================

Adaptated for CakePHP 2.4

This Behavior that automates the development of slug during a backup, either when the record was created or when editing.

To use, import the file in your CakePHP Model (app/Model) application folder.

Then add in the model you want to use:

    public $actsAs =  array('slug');

The default options are the Behavior:

Source field: "name"
Field for recording the slug: "slug"
Separator: "-"

You can change the options when calling the Behavior in your model like this:

    public $actsAs  = array(
      'Slug'  =>  array(
        'fieldName' =>  'title',
        'fieldSlug' =>  'slug2',
        'separator' =>  '_'
        )
      );

So, you have nothing else to do during each backup in your model, Behavior effectura the slug.
