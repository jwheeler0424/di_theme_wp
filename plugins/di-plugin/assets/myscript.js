window.addEventListener("load", () => {

    // store tabs variables
    const tabs = document.querySelectorAll('ul.nav-tabs > li');
    
    for (let i=0; i<tabs.length; i++) {
        tabs[i].addEventListener('click', switchTab);
    }

    function switchTab(e) {
        e.preventDefault();
        
        document.querySelector('ul.nav-tabs > li.active').classList.remove('active');
        document.querySelector('.tab-pane.active').classList.remove('active');

        const clickedTab = e.currentTarget;
        const anchor = e.target;
        const activePaneID = anchor.getAttribute('href');
        

        clickedTab.classList.add('active');
        document.querySelector(`div${activePaneID}`).classList.add('active');
        
    }

});