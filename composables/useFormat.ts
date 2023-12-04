export const usePageAbbr = (page) =>
    page.book.alias + ' '
    + page.path.replace(/^\/|\/$/g, '').replace(/\//g, '.')
    + (page.comment.trim() ? '' : '*')