<form action="/" method="get">
    <input style="border: none; border-bottom: 0.2rem solid black;" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
    <input type="hidden" name="post_type[]" value="show" />
    <input style="color: black; font-size: x-large; background-color: transparent; border: none; font-weight: 900; cursor: pointer;" type="submit" value="⌕" />
</form>