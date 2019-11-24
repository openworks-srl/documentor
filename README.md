# Documentor
PHP5 library to dynamically generate office document, starting from html page, twig template, data array, word template and more.
This software is just a sort of wrapper that use several great library toghether to easy generate document.
> The version 1.x has to be intended as Php 5.x compliant, a 2.x version (Php 7.x compliant) will be released soon.
> Some of the dependency may be old and/or may has been deprecated, because Php 5 has been officialy deprecated, but, for us, Php 5.x compliance is, right now, actualy a need.

The librarys taht this software is built on are (in no particular order):
- [mikehaertl/phpwkhtmltopdf](https://github.com/mikehaertl/phpwkhtmltopdf)
- [PHPOffice/PHPWord](https://github.com/PHPOffice/PHPWord)
- [PHPOffice/PHPExcel](https://github.com/PHPOffice/PHPExcel)
- [twigphp/Twig](https://github.com/twigphp/Twig)

## What can this library do?
More deatil on how to use each mode below this section.
#### Generate word (and word like) document such as .docx, .doc, .odt starting from:
- A plain html page
- A twig template (full twig syntaxs and constructs can be used, data can be passed to be filled in the template)
- Existing document template (.doc, .docx) (data can be passed to be filled in the template)
- Merging exisng document (.doc, .docx) with an html (or twig) part. (Useful for use with fancy/complex header or toc)
- Manually (using [PHPOffice/PHPWord](https://phpword.readthedocs.io/en/latest/general.html#) api)


#### Generate excel (and excel like) document such as .xlsx, .xls, .ods starting from:
- A plain html page
- A twig template (full twig syntaxs and constructs can be used, data can be passed to be filled in the template)
- Array of data (existing document template can be used)
- Manually (using [PHPOffice/PHPExcel](https://github.com/PHPOffice/PHPExcel/tree/1.8/Documentation/markdown/Overview) api)


#### Generate pdf document starting from:
- A plain html page
- A twig template (full twig syntaxs and constructs can be used, data can be passed to be filled in the template)
- An exsisting Word (docx, doc, odt) or Excel (xlsx, xls, ods) file.
- A Word template (.doc, .docx) (data can be passed to be filled in the template)


## How can i use this library?
> Coming soon...
## How this works internaly?
> Coming soon...
## How can i contribuite to this library?
> Coming soon...
