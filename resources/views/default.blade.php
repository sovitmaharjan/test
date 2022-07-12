{{-- 
    Insert Highlight.js styles from CDN
    or your own local css file
--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atelier-heath-dark.min.css" />

{{--
    Render the pre element with the code tag inside and respective classes.
    Note: don't forget to print the code generated by the library without
    escaping its content. With blade you can print it easily using {!! wont_escaped !!}
--}}
<pre>
    <code class="hljs {{ $code->language }}">{!! $code->value !!}</code>
</pre>