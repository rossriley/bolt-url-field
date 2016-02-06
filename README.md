# Custom URL field extension for use within Bolt CMS

This adds a new field with a type `url` that stores a plain text string but provides a more useful hydrated object
back to the frontend templates.

To add the field install this extension on your Bolt install and then modify your `contenttypes.yml` file to add a
new field, something like this:

```
fields:
    web:
        type: url
        label: Enter a web address
```

