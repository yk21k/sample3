(function() {
  const expire = 1; // 有効期限（日）
  let cc = document.querySelector('.cookie-consent');
  let ca = document.querySelector('.cookie-agree');
  const flag = localStorage.getItem('popupFlag');
  if (flag != null) {
    const data = JSON.parse(flag);
    if (data['value'] == 'true') {
      setTimeout(popup, 2000);
    } else {
      const current = new Date();
      if (current.getTime() > data['expire']) {
        setWithExpiry('popupFlag', 'true', expire);
        setTimeout(popup, 2000);
      }      
    }
  } else {
    setWithExpiry('popupFlag', 'true', expire);
    setTimeout(popup, 2000);
  }
  ca.addEventListener('click', () => {
    cc.classList.add('cc-hide1');
    setWithExpiry('popupFlag', 'false', expire);
  });
  
  function setWithExpiry(key, value, expire) {
    const current = new Date();
    expire = current.getTime() + expire * 24 * 3600 * 1000;
    const item = {
      value: value,
      expire: expire
    };
    localStorage.setItem(key, JSON.stringify(item));
  }
  
  function popup() {
    cc.classList.add('is-show');
  }
}());
