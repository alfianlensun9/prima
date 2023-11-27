
Vue.component('v-select', VueSelect.VueSelect);
Vue.use(window["vue-js-modal"].default);
Vue.use(VueMask.VueMaskPlugin);

const app = new Vue({
    delimiters: ['${', '}'],
    el: "#app",
    data: {
        chosenItemPerencanaan: null,
        chosenItemPersetujuan: null,
        showProfileData: false,
        showNavbarData: true,
        showFormInputData: false,
        showFormInputContentData: true,
        showLoaderSubmitData: false,
        showCloseButtonLoaderSubmit: false,
        messageLoaderSubmit: "",
        activePage : 'mainmenu',
        session: {},
    },

    computed: {
        profilePicture () {
            return `/images/${this.session.profile_picture ? this.session.profile_picture : ""}`
        }

    },

    created () {
        this.session = this.parseJwt(document.cookie)
        // alert()
    },

    methods: {
        parseJwt (token) {
            var base64Url = token.split('.')[1];
            var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
        
            return JSON.parse(jsonPayload);
        },
        getAuthGroup(){
            return this.session.auth_group
        },
        showLoaderSubmit(message, showCloseButton = false){
            this.showLoaderSubmitData = true
            this.messageLoaderSubmit = message,
            this.showCloseButtonLoaderSubmit = showCloseButton
        },
        hideLoaderSubmit(){
            this.showLoaderSubmitData = false
            this.messageLoaderSubmit = ""
        },  
        onClickCloseForm(){
            this.showFormInputData = false
        },
        getActivePage(){    
            return this.activePage
        },
        changeActivePage(page){
            this.activePage = page
        },
        showNav() {
            this.showNavbarData = !this.showNavbarData
        },
        showProfile(){
            this.showProfileData = !this.showProfileData
        },
        showFormInput(){
            this.showFormInputData = true
        },
        closeFormInput(){
            this.showFormInputData = false
        },
        onClickListPerencanaan(item){
            this.chosenItemPerencanaan = item
            this.changeActivePage('detaillistperencanaan')
        },
        onClickListPersetujuan(item){
            this.chosenItemPersetujuan = item
            this.changeActivePage('detaillistpersetujuan')
        },
        getChosenItemPerencanaan(){
            return this.chosenItemPerencanaan;
        },
        getChosenItemPersetujuan(){
            return this.chosenItemPersetujuan;
        },
        reRenderList(pageNow){
            this.changeActivePage('loader')
            setTimeout(() => {
                this.changeActivePage(pageNow)
            },5)
        },
        formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
    }
})