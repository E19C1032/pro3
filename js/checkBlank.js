/**
 * 文字列が空文字かどうか判定する。
 * @param {String} text テストする文字列。
 * @return {Boolean} 文字列が空白文字か？
 */
const isBlank = text => {
    if(!text.match(/\S/g)) return true;
    return false;
}