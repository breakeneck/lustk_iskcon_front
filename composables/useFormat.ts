export const formatPageAbbr = (page) =>
    (page.book ? page.book.alias : '') + ' '
    + page.path.replace(/^\/|\/$/g, '').replace(/\//g, '.')
    + (page.comment.trim() ? '' : '*')