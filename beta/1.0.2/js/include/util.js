/**
 * 文字列が空文字かどうか判定する。
 * @param {String} s テストする文字列。
 * @return {Boolean} 文字列が空文字か？
 */
const isBlank = s => {
    if(!s.match(/\S/g)) return true;
    return false;
}

/**
 * 文字列が空文字を含んでいるか判定する。
 * @param {String} s テストする文字列。
 * @return {Boolean} 文字列が空文字を含んでいるか？
 */
const hasBlank = s => {
    let r = /^(?=.*\s).*$/;
    if(r.test(s)) return true;
    return false;
}

/**
 * 正しいメールアドレスかどうか判定する。
 * @param {String} a メールアドレス
 * @return {Boolean} メールアドレスが正しいか？
 */
const isEmailAddress = a => {
    let r = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
    if(r.test(a)) return true;
    return false;
}

/**
 * 適切なパスワードかどうか判定する。
 * 適切なパスワード：8文字以上32文字以下、半角英数がそれぞれ１文字以上含まれている。次の記号を含んでも良い。　→　/*-+.,!#$%&()~|_
 * @param {String} p パスワード
 * @return {Boolean} 適切なパスワードか？
 */
const isPassword = p => {
    let r = /^(?=.*?[a-z])(?=.*?\d)(?=.*?[\/*\-+.,!#$%&()~|_])[a-z\d\/*\-+.,!#$%&()~|_]{8,32}|(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,32}$/i;
    let m = p.match(r);
    if(!(m instanceof Array)) return false;

    return m.length === 1 && m[0].length === p.length && r.test(p);
}
