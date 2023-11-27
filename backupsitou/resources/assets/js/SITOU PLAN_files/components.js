
Vue.component('v-select', VueSelect.VueSelect);
Vue.use(VueMask.VueMaskPlugin);
Vue.use(window["vue-js-modal"].default);
Vue.component(VueQrcode.name, VueQrcode)
const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css',
        '/css/tailwind.min.css',
        '/css/vue-select.css',
        '/css/print.css'
    ]
}

Vue.use(VueHtmlToPaper, options);

Vue.component('headerSitou',{
    props: ['showprofil', 'shownavbar'],
    data: () => {
        return {
            showEditProfileButton: false,
            showChangePassword: false,
            showPasswordSebelum: false,
            showPassword: false,
            showPasswordConfirm: false,
            passwordSebelum: '',
            password: '',
            passwordConfirm: '',
            profilePicture: '',
            urlPicPreview: '',
            enableSimpanProfilePicture: false
        }
    },
    methods: {
        parentShowNavbar() {
            this.$parent.showNav();
        },
        parentShowProfil() {
            this.$parent.showProfile();
        },
        logout () {
            window.location = "/front/logout"
            
        },
        hoverProfile(){
            this.showEditProfileButton = true
        },
        unhoverProfile(){
            this.showEditProfileButton = false
        },
        onClickBtnChangeProfilePicture(){
            this.$modal.show('showChangeProfil');
        },
        onClickBtnHideChangeProfilePicture(){
            this.$modal.hide('showChangeProfil');
        },
        onClickBtnChangePassword(){
            this.$modal.show('showChangePassword')
        },
        onClickBtnHideChangePassword(){
            this.$modal.hide('showChangePassword')
        },
        onChangeProfilePicture(){
            this.profilePicture = this.$refs.profilePicture.files[0]
            this.urlPicPreview = URL.createObjectURL(this.profilePicture);
            this.enableSimpanProfilePicture = true
        },
        onClickUploadProfilePicture(){
            this.$refs.profilePicture.click()
        },
        onClickShowPassword(id){
            if (id == 1){
                this.showPasswordSebelum = !this.showPasswordSebelum
            }
            else
            if (id == 2){
                this.showPassword = !this.showPassword
            }
            else
            if (id == 3){
                this.showPasswordConfirm = !this.showPasswordConfirm
            }
        },
        simpanPerubahanPassword(){
            this.$parent.showLoaderSubmit('Memeriksa password sebelum')
            this.$modal.hide('showChangePassword')
            axios.post('/api/auth/cek-password',
            {
                username: this.$parent.session.username,
                password: this.passwordSebelum,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                if (response.data.status == 200){
                    if (this.password == this.passwordConfirm){
                        this.simpanPasswordBaru()
                    } else {
                        this.$parent.showLoaderSubmit('Password tidak cocok...' , true)
                        this.$modal.show('showChangePassword')
                    }
                } else {
                    this.$parent.showLoaderSubmit('Password salah...' , true)
                    this.$modal.show('showChangePassword')
                }
            })
            .catch((error) => {
                this.$modal.show('showChangePassword')
                this.$parent.showLoaderSubmit('Terjadi kesalahan saat memeriksa password...' , true)
            });
        },
        simpanPasswordBaru(){
            this.$parent.showLoaderSubmit('Menyimpan password baru')
            axios.post('/api/auth/update-password',
            {
                username: this.$parent.session.username,
                password: this.password,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                if (response.data.status == 200){
                    this.$parent.showLoaderSubmit('Berhasil mengganti password' , true)
                    this.passwordSebelum = '',
                    this.password = '',
                    this.passwordConfirm = ''
                } else {
                    this.$parent.showLoaderSubmit('Gagal mengganti password' , true)
                    this.$modal.show('showChangePassword')
                }
            })
            .catch((error) => {
                this.$parent.showLoaderSubmit('Terjadi kesalahan saat menyimpan password...' , true)
                this.$modal.show('showChangePassword')
                console.log(error);
            });
        },
        onClickUpdateProfilePicture(){
            if (this.enableSimpanProfilePicture == false){
                return false
            }
            this.$parent.showLoaderSubmit('Mengupdate foto profil...')
            let formData = new FormData()
            formData.append('username', this.$parent.session.username)
            formData.append('profilePicture', this.profilePicture)
            axios.post('/api/auth/update-profile-picture',
            formData,
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                if (response.data.picture != ''){
                    this.$parent.showLoaderSubmit('Foto profil berhasil di perbarui' , true)
                    this.$parent.session.profile_picture = response.data.picture
                } else {
                    this.$parent.showLoaderSubmit('Gagal mengganti foto profil' , true)
                }
            })
            .catch((error) => {
                this.$parent.showLoaderSubmit('Gagal mengganti foto profil' , true)
            });
        }
    },
    created(){
        console.log(this.$parent.session)  
    },
    template : `
       <div class="md:flex lg:flex py-3 px-4 justify-center border hide-on-print" >
            <modal
                :width="'80%'" 
                :height="'70%'"
                name="showChangeProfil">
                <div class="w-full">
                    <div class="w-full flex shadow-lg px-5 py-5 text-lg">
                        <h1 class="font-medium">Pilih Foto Profil</h1>
                        <button class="right-0 h-10 w-10 hover:bg-gray-200 top-0 mt-2 rounded-full absolute mr-5 focus:outline-none" @click="onClickBtnHideChangeProfilePicture"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="w-full justify-center flex text-gray-400 mt-32">
                        <div class="w-32 h-32 bg-gray-300 rounded-full overflow-hidden" v-if="urlPicPreview != '' ? true : false">
                            <img :src="urlPicPreview"  alt="">
                        </div>
                        <i class="fa fa-camera fa-4x" v-if="urlPicPreview == '' ? true : false"></i>
                    </div>
                    <div class="w-full justify-center flex mt-16">
                        <input 
                            type="file" 
                            class="hidden"
                            accept="image/*" 
                            ref="profilePicture"
                            @change="onChangeProfilePicture"
                            >
                        <button class="px-2 py-2 rounded-lg bg-gray-300 focus:outline-none text-gray-600 font-light" @click="onClickUploadProfilePicture">Pilih foto dari komputer anda</button>
                    </div>
                    <div class="absolute border-t bottom-0 w-full">
                        <div class="w-full px-4 py-4 flex">
                            <button 
                                class="px-5 py-2 rounded-lg cursor-pointer text-white shadow-lg focus:outline-none" 
                                v-bind:class="{
                                    'bg-blue-400': enableSimpanProfilePicture, 
                                    'hover:bg-blue-300': enableSimpanProfilePicture,
                                    'bg-blue-300': !enableSimpanProfilePicture, 
                                    'hover:bg-blue-300': !enableSimpanProfilePicture 
                                }"
                                @click="onClickUpdateProfilePicture"
                                >
                                Tetapkan sebagai foto profil</button>
                            <button class="px-5 py-2 rounded-lg ml-2 shadow-lg bg-white focus:outline-none hover:bg-gray-200 text-gray-600" @click="onClickBtnHideChangeProfilePicture">Batal</button>
                        </div>
                    </div>
                </div>
            </modal>
            <modal
                :width="'60%'" 
                :height="'50%'"
                name="showChangePassword">
                <div class="w-full">
                    <div class="w-full flex shadow-lg px-5 py-5 text-lg text-gray-700">
                        <h1 class="font-medium"><i class="fa fa-lock"></i> Ganti Password</h1>
                        <button class="right-0 h-10 w-10 hover:bg-gray-200 top-0 mt-2 rounded-full absolute mr-5 focus:outline-none" @click="onClickBtnHideChangePassword"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="w-full px-4 py-5">
                        <div class="w-full">
                            <label for="passwordSebelum" class="font-light text-gray-800">Password Sebelum</label>
                            <div class="w-full flex">
                                <div class="w-5/6">
                                    <input 
                                    tabindex="1"
                                    placeholder="Masukan password sebelum"
                                    v-model="passwordSebelum"
                                    :type="showPasswordSebelum ? 'text' : 'password'"  
                                    class="h-8 rounded-lg px-2 w-full bg-gray-200 mt-2 focus:outline-none" id="passwordSebelum">
                                </div>
                                <div class="w-1/6 pt-2">
                                    <button 
                                        @click="onClickShowPassword(1)" 
                                        class="h-8 w-8 ml-2 bg-gray-200 rounded-full focus:outline-none">
                                        <i v-bind:class="{'fa-eye': !showPasswordSebelum , 'fa-eye-slash': showPasswordSebelum }" class="fa text-gray-800"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-4">
                            <label for="password" class="font-light text-gray-800">Password</label>
                            <div class="w-full flex">
                                <div class="w-5/6">
                                    <input 
                                    tabindex="2"
                                    placeholder="Password baru"
                                    v-model="password"
                                    :type="showPassword ? 'text' : 'password'"  
                                    class="h-8 rounded-lg px-2 w-full bg-gray-200 mt-2 focus:outline-none" id="password">
                                </div>
                                <div class="w-1/6 pt-2">
                                    <button 
                                        @click="onClickShowPassword(2)" 
                                        class="h-8 w-8 ml-2 bg-gray-200 rounded-full focus:outline-none">
                                        <i v-bind:class="{'fa-eye': !showPassword , 'fa-eye-slash': showPassword }" class="fa text-gray-800"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-4">
                            <label for="passwordConfirm" class="font-light text-gray-800">Konfirmasi Password</label>
                            <div class="w-full flex">
                                <div class="w-5/6">
                                    <input 
                                    tabindex="3"
                                    placeholder="Konfirmasi Password"
                                    v-model="passwordConfirm"
                                    :type="showPasswordConfirm ? 'text' : 'password'"  
                                    class="h-8 rounded-lg px-2 w-full bg-gray-200 mt-2 focus:outline-none" id="passwordConfirm">
                                </div>
                                <div class="w-1/6 pt-2">
                                    <button 
                                        @click="onClickShowPassword(3)" 
                                        class="h-8 w-8 ml-2 bg-gray-200 rounded-full focus:outline-none">
                                        <i v-bind:class="{'fa-eye': !showPasswordConfirm , 'fa-eye-slash': showPasswordConfirm }" class="fa text-gray-800"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-4">
                            <button 
                            tabindex="4"    
                            class="bg-blue-400 px-4 py-2 rounded-lg text-white focus:outline-none hover:bg-blue-300" @click="simpanPerubahanPassword">Simpan</button>
                        </div>
                    </div>
                </div>
            </modal>
            <div class="w-full lg:w-1/5 md:w-1/5 bg-white align-middle inline-block">
                <div class="flex">
                    <div class="w-1/5">
                        <button class="rounded-full overflow-hidden hover:bg-gray-300 w-10 h-10 flex justify-center align-middle outline-none cursor-pointer focus:outline-none" @click="parentShowNavbar">
                            <i class="fa fa-bars fa-1x"></i>
                        </button>
                    </div>
                    <div class="w-4/5">
                        <div class="font-bold">
                            SITOU PLAN
                        </div>
                        <div class="w-full text-xs">Sistem Internal Teknologi User PLAN</div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/5 md:w-3/5  bg-white">    
                <div class="flex h-10 lg:h-full md:h-full">
                    <input type="text" placeholder="Pencarian" class="w-3/4 bg-gray-300 rounded-lg h-10 w-full h-full rounded-lg bg-transparent outline-none px-5 focus:shadow-md focus:bg-white">
                </div>
            </div>
            <div class="w-full lg:w-1/5 md:w-1/5 mt-4 sm:mt-4 md:mt-0 lg:mt-0 justify-end flex ">
                <div class="rounded-full overflow-hidden bg-gray-300 w-10 h-10 flex justify-center align-middle outline-none hover:shadow-outline cursor-pointer hover:border-gray-600" v-on:click="parentShowProfil">
                    <img :src="this.$parent.profilePicture" alt="" v-if="this.$parent.profilePicture != '/images/' ? true : false">
                    <div class="w-full bg-blue-400 h-full justify-center flex" v-if="this.$parent.profilePicture == '/images/' ? true : false">
                        <div class="text-white font-medium self-center text-lg">
                            {{this.$parent.session.first_name.charAt(0)}}
                        </div>
                    </div>
                </div>
                <div class="absolute bg-white w-1/3 right-20 top-0 mt-16 shadow-md border py-3 px-4" v-if="showprofil">
                    <div class="flex">
                        <div class="w-1/3 relative">
                            <div 
                                class="rounded-full overflow-hidden bg-gray-200 w-24 h-24 flex justify-center align-middle outline-none hover:shadow-outline hover:border-gray-600 cursor-pointer"
                                @mouseover="hoverProfile"
                                @mouseleave="unhoverProfile"
                                >
                                <img :src="this.$parent.profilePicture" alt="" v-if="this.$parent.profilePicture != '/images/' ? true : false" class="cursor-pointer">
                                <div class="w-full bg-blue-400 justify-center flex" v-if="this.$parent.profilePicture == '/images/' ? true : false">
                                    <div class="text-white font-medium self-center text-4xl">
                                        {{this.$parent.session.first_name.charAt(0)}}
                                    </div>
                                </div>
                                <div class="transparent-profil-change" v-if="showEditProfileButton" @click="onClickBtnChangeProfilePicture">
                                    <i class="fa fa-camera"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-2/3 px-5">
                            <div class="text-lg">
                                    {{ this.$parent.session.first_name }} {{ this.$parent.session.last_name }}
                            </div>
                            <div class="text-sm">
                                    Verlos Kamer (VK)
                            </div>
                            <div class="w-full flex">
                                <button 
                                    class="shadow-md px-4 py-2 rounded-lg hover:shadow-lg border mt-2 focus:outline-none" 
                                    @click="onClickBtnChangePassword"
                                    >
                                    <i class="fa fa-lock text-gray-700"></i>
                                </button>
                                <button 
                                    class="shadow-md ml-4 px-4 py-2 rounded-lg hover:shadow-lg border mt-2 focus:outline-none" 
                                    @click="logout"
                                    >
                                    <div class="text-gray-700">
                                        Logout
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    `
});

Vue.component('sidebarSitou',{
    props:['shownavbar'],
    data: () => {
        listPage = {
            authGroup: null,
            pageName: 'Perencanaan',
            pageMainMenu: true,
            pageMasterAlkes: false,
            pageMasterIndikator: false,
            pageMasterUser: false,
            pagePersetujuan: false,
            pageRkakl: false
        }
        return{
            listPage,
            showMainMenu: false,
            showPersetujuan: false,
            showRKAKL: false,
            showLaporan: false,
            showMasterAlkes: false,
            showMasterUser: false
        }
    },
    created(){
        this.authGroup = this.$parent.getAuthGroup();
        // this.authGroup = '1'
        user = ['1','2','3','4']
        pimpinan = ['5']
        admin = ['6']
        if (user.indexOf(this.authGroup) != -1){
            this.showMainMenu = true
            this.showRKAKL = true
            this.showMasterAlkes = true
        }
        else
        if (pimpinan.indexOf(this.authGroup) != -1){
            this.parentChangeActivePage('persetujuan')
            this.showPersetujuan = true
            this.showLaporan = true
            this.showMasterAlkes = true
        }
        else
        if (admin.indexOf(this.authGroup) != -1){
            this.parentChangeActivePage('masteralkes')
            this.showMasterAlkes = true
            this.showMasterUser = true
        }
    },
    methods: {
        parentShowFormInput(){
            this.$parent.showFormInput()
        },
        parentChangeActivePage(page){
            this.listPage = {
                pageName: 'Perencanaan',
                pageMainMenu: false,
                pageEplanning: false,
                pageMasterUser: false,
                pageMasterIndikator: false,
                pageMasterAlkes: false,
                pageMasterUser: false,
                pagePersetujuan: false,
                pageLaporan: false,
                pageRkakl: false
            }
            if (page == 'mainmenu'){
                this.listPage.pageName = 'Perencanaan'
                this.listPage.pageMainMenu = true
            }
            else 
            if (page == 'masteruser'){
                this.listPage.pageName = 'User'
                this.listPage.pageMasterUser = true
            }
            else
            if (page == 'masteralkes'){
                this.listPage.pageName = 'Alkes'
                this.listPage.pageMasterAlkes = true
            }
            else
            if (page == 'eplanning'){
                this.listPage.pageName = 'E-Planning'
                this.listPage.pageEplanning = true
            }
            else
            if (page == 'persetujuan') 
            {
                this.listPage.pageName = 'Persetujuan'
                this.listPage.pagePersetujuan = true
            }
            else
            if (page == 'laporan')
            {   
                this.listPage.pageName = 'Laporan'
                this.listPage.pageLaporan = true
            }
            else
            if (page == 'rkakl'){
                this.listPage.pageName = 'RKAKL'
                this.listPage.pageRkakl = true
            }
            this.$parent.changeActivePage(page)
        }
    },
    template: `
        <div class="w-3/5 lg:w-1/4 md:w-1/4 sm:w-1/4 h-screen hide-on-print"  v-if="shownavbar">
            <button v-if="listPage.pageName == 'Perencanaan'" class="transition mx-3 mt-4 rounded-full py-3 px-4 border-t  border-gray-200 shadow-lg focus:outline-none hover:shadow-xl" @click="parentShowFormInput">
                <i class="fa fa-plus text-gray-700"></i> <span class="ml-2">Tambah {{listPage.pageName}}</span>
            </button>
            <div class="w-3/4 pt-4 text-sm">
                <div 
                    v-if="showMainMenu"
                    class="w-full my-3 py-1 rounded-r-full px-4 cursor-pointer text-sm" v-bind:class="{'bg-red-200': listPage.pageMainMenu, 'hover:bg-gray-100': !listPage.pageMainMenu}" @click="parentChangeActivePage('mainmenu')">
                    Menu Utama
                </div>
                <div 
                    v-if="showPersetujuan"
                    class="w-full my-3 py-1 rounded-r-full px-4 cursor-pointer text-sm" v-bind:class="{'bg-red-200': listPage.pagePersetujuan, 'hover:bg-gray-100': !listPage.pagePersetujuan}" @click="parentChangeActivePage('persetujuan')">
                    Persetujuan
                </div>
                <!-- <div class="w-full my-3 py-1 rounded-r-full px-4 cursor-pointer text-sm" v-bind:class="{'bg-red-200': listPage.pageEplanning, 'hover:bg-gray-100': !listPage.pageEplanning}" @click="parentChangeActivePage('eplanning')">
                    E-Planning
                </div> -->
                <div
                    v-if="showRKAKL" 
                    class="w-full my-3 py-1 rounded-r-full px-4 cursor-pointer text-sm" v-bind:class="{'bg-red-200': listPage.pageRkakl, 'hover:bg-gray-100': !listPage.pageRkakl}" @click="parentChangeActivePage('rkakl')">
                    RKAKL
                </div>
                <div 
                    v-if="showLaporan"
                    class="w-full my-3 py-1 rounded-r-full px-4 cursor-pointer text-sm" v-bind:class="{'bg-red-200': listPage.pageLaporan, 'hover:bg-gray-100': !listPage.pageLaporan}" @click="parentChangeActivePage('laporan')">
                    Laporan
                </div>
                <div 
                    v-if="showMasterAlkes"
                    class="w-full my-3 py-1 rounded-r-full px-4 cursor-pointer text-sm" v-bind:class="{'bg-red-200': listPage.pageMasterAlkes, 'hover:bg-gray-100': !listPage.pageMasterAlkes}" @click="parentChangeActivePage('masteralkes')">
                    Master Alkes
                </div>
                
                <div 
                    v-if="showMasterUser"
                    class="w-full my-3 py-1 rounded-r-full px-4 cursor-pointer text-sm" v-bind:class="{'bg-red-200': listPage.pageMasterUser, 'hover:bg-gray-100': !listPage.pageMasterUser}" @click="parentChangeActivePage('masteruser')">
                    Master User
                </div>
            </div>
            <div class="border-b border-gray-300 border-t flex py-2 px-2">
                <div class="w-1/6 bg-white align-middle inline-block">
                    <div class="rounded-full overflow-hidden bg-gray-100 w-10 h-10 flex justify-center align-middle outline-none hover:shadow-outline hover:border-gray-600">
                        <img :src=this.$parent.profilePicture alt="" v-if="this.$parent.profilePicture != '/images/' ? true : false">
                        <div class="w-full bg-blue-400 h-full justify-center flex" v-if="this.$parent.profilePicture == '/images/' ? true : false">
                            <div class="text-white font-medium self-center text-lg">
                                {{this.$parent.session.first_name.charAt(0)}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-2 w-4/6 hidden lg:block md:block sm:block inline-block align-middle pt-2 pl-2 text-sm" >    
                    {{ this.$parent.session.first_name }} {{ this.$parent.session.last_name }}
                </div>
                <div class="w-1/6 inline-block align-middle pt-1 pl-2 justify-end flex">    
                    <div class="w-8 h-8 rounded-full flex justify-center pt-1 hover:bg-gray-300 cursor-pointer">
                        
                    </div>
                </div>
            </div> 

            <div class="p-2">
                <h2 class="text-base font-bold text-gray-700">Visi</h2>
                <p class="text-xs">Pusat Rujukan di Wilayah Kabupaten Minahasa Tenggara dan Kabupaten Bolaang Mongondow Timur Tahun 2019</p>
                <h3 class="text-base font-bold text-gray-700">Misi</h3>
                <p class="text-xs">a. Menyelenggarakan pelayanan yang profesional, akuntabel dan terjangkau. <br> b. Meningkatkan dan mengembangkan SDM yang berkualitas dan beretika serta meningkatkan kesejahteraan</p>
            </div>
        </div>
    `
})

Vue.component('wrapperFormInputPersetujuan',{
    data: () => {
        return {
            valid: "1",
            komentar: "",
            indikator: "",
            chosenItemPerencanaan: null,
            idMstAlasanPending: null,
            optionsAlasanPending : [],
            indikator: [],
            prioritas: '3'
        }
    },
    created(){
        this.chosenItemPerencanaan = this.$parent.$parent.getChosenItemPersetujuan()
        console.log(this.chosenItemPerencanaan.id_trx_perencanaan)
        axios.get('/api/master-alasan-pending',
        {
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
            },
        }
        ).then((response) => {
            if (response.status == 200){
                this.optionsAlasanPending = response.data
            }
        })
        .catch(function(error){
            console.log(error);
        });
    },
    methods: {    
        reRenderList(){
            this.$parent.$parent.changeActivePage('loader')
            setTimeout(() => {
                this.$parent.$parent.changeActivePage('masteralkes')
            },5)
        },
        onClickSimpanValidasi(){
            this.$parent.$parent.showLoaderSubmit('Menyimpan validasi...')
            this.$parent.$parent.closeFormInput()
            axios.post('/api/perencanaan/validasi',
            {
                alasanPending: this.idMstAlasanPending != null ? this.idMstAlasanPending.id_mst_alasan_pending : 0,
                idTrxPerencanaan: this.chosenItemPerencanaan.id_trx_perencanaan,
                validStatus: this.valid,
                prioritas: this.prioritas,
                indikator: this.indikator.join(','),
                komentar: this.komentar,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                if (response.status == 200){
                    this.$parent.$parent.showLoaderSubmit('Validasi berhasil di simpan...', true)
                    this.$parent.$parent.changeActivePage('persetujuan')
                    console.log(response)
                } else {
                    this.$parent.$parent.showLoaderSubmit('Gagal menyimpan validasi...' ,true)
                }
            })
            .catch(function(error){
                this.$parent.$parent.showLoaderSubmit('Gagal menyimpan validasi...', true)
                console.log(error);
            });
        }
    },
    template: `
        <div class="w-full">
            <div class="w-full">
                <div class="w-full flex shadow-lg px-2 py-2 rounded-lg">
                    <div class="w-1/3">
                        <input 
                            id="valid" 
                            v-model="valid" 
                            value="1" 
                            type="radio" 
                            name="valid"/> 
                        <label 
                            for="valid" 
                            class="cursor-pointer"
                            > 
                            Valid
                        </label>
                    </div>
                    <div class="w-1/3">
                        <input 
                            id="tidak-valid" 
                            v-model="valid" 
                            value="0" 
                            type="radio" 
                            name="valid"/> 
                        <label 
                            for="tidak-valid" 
                            class="cursor-pointer"
                            > 
                            Pending
                        </label>
                    </div>
                </div>
                <div class="w-full shadow-lg px-2 py-2 mt-4 rounded-lg" v-if="valid == 1 ? true : false">
                    <div class="w-full flex">
                        <div class="w-1/3">
                            <input 
                                id="prioritas1" 
                                v-model="prioritas" 
                                value="1" 
                                type="radio" 
                                name="prioritas"/> 
                            <label 
                                for="prioritas1" 
                                class="cursor-pointer"
                                > 
                                Prioritas I
                            </label>
                        </div>
                        <div class="w-1/3">
                            <input 
                                id="prioritas2" 
                                v-model="prioritas" 
                                value="2" 
                                type="radio" 
                                name="prioritas"/> 
                            <label 
                                for="prioritas2" 
                                class="cursor-pointer"
                                > 
                                Prioritas II
                            </label>
                        </div>
                        <div class="w-1/3">
                            <input 
                                id="prioritas3" 
                                v-model="prioritas" 
                                value="3" 
                                type="radio" 
                                name="prioritas"/> 
                            <label 
                                for="prioritas3" 
                                class="cursor-pointer"
                                > 
                                Prioritas III
                            </label>
                        </div>
                    </div>
                </div>
                <div class="w-full mt-4" v-if="valid == 1 ? true : false">
                    <div class="w-full py-2 px-4 shadow-lg rounded-lg px-2">
                        <h1 class="">Indikator</h1>
                        <hr>
                        <div class="w-full py-3">
                            <div class="w-1/2">
                                <input 
                                    type="checkbox" 
                                    id="Geriatri"
                                    v-model="indikator"
                                    value="1"
                                    >
                                <label for="Geriatri" class="cursor-pointer">Geriatri</label>
                            </div>
                        </div>
                        <div class="w-full py-2">
                            <div class="w-1/2">
                                <input 
                                    type="checkbox" 
                                    id="Ponek" 
                                    v-model="indikator"
                                    value="2">
                                <label for="Ponek" class="cursor-pointer">Ponek</label>
                            </div>
                        </div>
                        <div class="w-full py-2">
                            <div class="w-1/2">
                                <input 
                                    type="checkbox" 
                                    id="Lain" 
                                    v-model="indikator"
                                    value="3">
                                <label for="Lain" class="cursor-pointer">Lain - lain</label>
                            </div>
                        </div>
                    </div>
                    <div class="w-full py-2 px-4 shadow-lg rounded-lg px-2">
                        <h1 class="">Komentar</h1>
                        <hr>
                        <textarea 
                            v-model="komentar"
                            cols="30" 
                            class="w-full bg-gray-200 rounded-lg focus:outline-none mt-4 px-2 py-2" 
                            rows="10">
                        </textarea>
                    </div>  
                </div>
                <div class="w-full mt-4" v-if="valid == 0 ? true : false">
                    <div class="w-full py-2 px-4 shadow-lg rounded-lg px-2">
                        <h1 class="">Alasan Pending</h1>
                        <hr>
                        <v-select 
                            label="Alasan Pending" 
                            :filterable="false" 
                            :options="optionsAlasanPending"  
                            v-model="idMstAlasanPending" >
                            <template slot="no-options">
                                Belum ada alasan pending...
                            </template>
                            <template slot="option" slot-scope="option">
                                <div class="d-center">
                                {{ option.keterangan }}
                                </div>
                            </template>
                            <template slot="selected-option" slot-scope="option">
                                <div class="selected d-center">
                                {{ option.keterangan }}
                                </div>
                            </template>
                        </v-select>
                    </div>  
                </div>
            </div>
            <div class="w-full">
                <button 
                    class="px-2 py-2 bg-blue-400 text-white mt-4 rounded focus:outline-none" @click="onClickSimpanValidasi">
                    Simpan
                </button>
            </div>
        </div>
    `
})



Vue.component('wrapperFormInputPerencanaan', {
    data: () => {
        return {
            options: [],
            optionsKategori: [{
                id_mst_kategori_perencanaan: 1,
                keterangan: "Alat kesehatan"
            },
            {
                id_mst_kategori_perencanaan: 2,
                keterangan: "Barang Habis Pakai"
            }],
            kategori: "",
            idMstAlkes: "",
            idMstKategoriPerencanaan: "",
            kuantitas: "",  
            harga: "",
            justifikasi: "",
            umurAset: "< 1 Tahun",
            mudahRusak: 0,
            mudahHilang: 0,
            ePlanning: 0,
            fileDataPendukung: "",
            namaAlkesNonEplanning: ""
        }
    },
    created(){
       
    },
    methods: {
        reRenderList(){
            this.$parent.$parent.changeActivePage('loader')
            setTimeout(() => {
                this.$parent.$parent.changeActivePage('mainmenu')
            },5)
        },
        onSearchAlkes(search, loading){
            loading(true)
            this.search(loading, search, this);
        },  
        search(loading, search, vm){
            let completeSearch = search != '' ?  search : 0
            axios.get('http://ratatotokbuyathospital.com:9991/api/alkes/redis/'+completeSearch,
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                console.log(response)
                if (response.status == 200){
                    vm.options = response.data
                    loading(false);
                } else {
                    
                }
            })
            .catch(function(error){
                console.log(error);
            });
        },
        resetFormValue(){
            this.idMstAlkes = ""
            this.kuantitas = ""
            this.harga = ""
            this.justifikasi = ""
            this.umurAset = "< 1 Tahun"
            this.mudahHilang = 0
            this.ePlanning = 0
            this.fileDataPendukung = ""
        },
        onClickUploadDataPendukung(){
            this.$refs.fileDataPendukung.click()
        },
        onChangeFileDataPendukung(){
            this.fileDataPendukung = this.$refs.fileDataPendukung.files[0]
        },
        onClickSimpanPerencanaan(){
            if (this.fileDataPendukung == ''){
                this.$parent.$parent.showLoaderSubmit('Anda belum menginput data pendukung..!!')
                return false
            }
            let formData = new FormData()
            formData.append('idMstAlkes', this.idMstAlkes.Id)
            formData.append('idMstKategoriPerencanaan', this.idMstKategoriPerencanaan.id_mst_kategori_perencanaan)
            formData.append('kuantitas', this.kuantitas)
            formData.append('harga', this.harga.replace(/[.]+/g,""))
            formData.append('justifikasi', this.justifikasi)
            formData.append('umurAset', this.umurAset)
            formData.append('mudahHilang', this.mudahHilang)
            formData.append('ePlanning', this.ePlanning)
            formData.append('fileDataPendukung', this.fileDataPendukung)
            formData.append('idUserInputer', this.$parent.$parent.session.id_telegram)
            formData.append('userGroup', 'vk')
            formData.append('namaAlkesNonEplanning', this.namaAlkesNonEplanning)
            this.$parent.$parent.showLoaderSubmit('Menambah data...')
            let url
            if (this.ePlanning == 0){
                url = '/api/perencanaan'
            } else {
                url = '/api/perencanaan-non-eplanning'
            }
            axios.post(url,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                this.$parent.$parent.hideLoaderSubmit()
                if (response.status == 200){
                    this.$parent.$parent.showLoaderSubmit('Data berhasil di simpan...', true)
                    this.$parent.$parent.onClickCloseForm()
                    this.reRenderList()
                    this.resetFormValue()
                } else {
                    console.log('gagal')
                    this.$parent.$parent.showLoaderSubmit('Gagal menambahkan data..!');
                }
            })
            .catch(function(error){
                console.log(error);
                this.$parent.$parent.hideLoaderSubmit()
            });
        }
    },
    template: `
        <div class="w-full">
            <div class="w-full " v-if="ePlanning == 0 ? true : false ">
                <div class="mb-2">Nama</div>
                <v-select 
                    label="name" 
                    :filterable="false" 
                    :options="options" 
                    @search="onSearchAlkes" 
                    v-model="idMstAlkes" >
                    <template slot="no-options">    
                        Data alkes tidak di temukan..
                    </template>
                    <template slot="option" slot-scope="option">
                        <div class="d-center">
                        {{ option.Properties.nama_alat_kesehatan }}
                        </div>
                    </template>
                    <template slot="selected-option" slot-scope="option">
                        <div class="selected d-center">
                        {{ option.Properties.nama_alat_kesehatan }}
                        </div>
                    </template>
                </v-select>
            </div>
            <div class="w-full" v-if="ePlanning == 1 ? true : false ">
                <input type="text" v-model="namaAlkesNonEplanning" class="h-10 w-full px-2 bg-gray-300 rounded-lg focus:outline-none" placeholder="Masukan Nama Alkes">
            </div>
            <div class="w-full mt-2">
                <div class="mb-2">Kategori</div>
                <v-select 
                    label="name" 
                    :filterable="false" 
                    :options="optionsKategori"  
                    v-model="idMstKategoriPerencanaan" >
                    <template slot="no-options">
                        Kategori..
                    </template>
                    <template slot="option" slot-scope="option">
                        <div class="d-center">
                        {{ option.keterangan }}
                        </div>
                    </template>
                    <template slot="selected-option" slot-scope="option">
                        <div class="selected d-center">
                        {{ option.keterangan }}
                        </div>
                    </template>
                </v-select>
            </div>
            <div class="w-full my-4">
                <input 
                    type="number" 
                    class="h-8 outline-none border-b w-full" 
                    v-model="kuantitas" 
                    placeholder="Kuantitas">
            </div>
            <div class="w-full my-4">
                <input 
                    type="text" 
                    class="h-8 outline-none border-b w-full" 
                    v-model="harga"
                    v-mask="'###.###.###.###.###.###'" 
                    placeholder="Harga">
            </div>
            <div class="w-full my-4">
                <input 
                    type="text" 
                    class="h-8 outline-none border-b w-full" 
                    v-model="justifikasi" 
                    placeholder="Justifikasi">
            </div>
            
            <div class="w-full my-4 pb-4 shadow-lg overflow-hidden rounded-lg">
                <div class="flex">
                    <div class="w-1/5 pl-4 bg-gray-200 py-2 rounded-br-lg">
                        Kategori 
                    </div>
                </div>
                <div class="flex px-4 mt-4">
                    <div class="w-2/5">
                        Umur Aset
                    </div>
                    <div class="w-3/5 flex">
                        <div class="w-2/5">
                            <input 
                                id="less-than-one-year" 
                                v-model="umurAset" 
                                value="< 1 Tahun" 
                                type="radio" 
                                name="umur_aset"/> 
                            <label 
                                for="less-than-one-year" 
                                class="cursor-pointer"
                                > 
                                    < 1 Tahun
                                </label>
                        </div>
                        <div class="w-2/5">
                            <input 
                                id="more-than-one-year" 
                                v-model="umurAset" 
                                value="> 1 Tahun" 
                                type="radio" 
                                name="umur_aset" 
                                />
                            <label 
                                for="more-than-one-year"  
                                class="cursor-pointer"
                                > 
                                    > 1 Tahun 
                                </label>
                        </div>
                    </div>
                </div>
                <div class="flex px-4 mt-4">
                        <div class="w-2/5">
                            Mudah Rusak
                        </div>
                        <div class="w-3/5 flex">
                            <div class="w-2/5">
                                <input 
                                    id="mudah-rusak-ya" 
                                    v-model="mudahRusak" 
                                    value="1" type="radio" 
                                    name="mudahRusak" 
                                    class=""
                                    /> 
                                <label 
                                    for="mudah-rusak-ya" 
                                    class="cursor-pointer"
                                    >
                                    Ya
                                </label>
                            </div>
                            <div class="w-2/5">
                                <input 
                                    id="mudah-rusak-tidak" 
                                    v-model="mudahRusak" 
                                    value="0" type="radio" 
                                    name="mudahRusak" 
                                    class=""/>
                                <label 
                                    for="mudah-rusak-tidak" 
                                    class="cursor-pointer"
                                    >
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                <div class="flex px-4 mt-4">
                    <div class="w-2/5">
                        Mudah Hilang
                    </div>
                    <div class="w-3/5 flex">
                        <div class="w-2/5">
                            <input 
                                id="mudah-hilang-ya" 
                                v-model="mudahHilang" 
                                value="0" type="radio" 
                                name="mudah_hilang" 
                                class=""
                                /> 
                            <label 
                                for="mudah-hilang-ya" 
                                class="cursor-pointer"
                                >
                                Ya
                            </label>
                        </div>
                        <div class="w-2/5">
                            <input 
                                id="mudah-hilang-tidak" 
                                v-model="mudahHilang" 
                                value="1" type="radio" 
                                name="mudah_hilang" 
                                class=""/>
                            <label 
                                for="mudah-hilang-tidak" 
                                class="cursor-pointer"
                                >
                                Tidak
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex px-4 mt-4">
                    <div class="w-2/5">
                        E-Planning
                    </div>
                    <div class="w-3/5 flex">
                        <div class="w-2/5">
                            <input 
                                id="e-planning-ya" 
                                v-model="ePlanning" 
                                value="0" 
                                type="radio" 
                                name="e_planning" 
                                /> 
                            <label 
                                for="e-planning-ya"> 
                                Ya
                            </label>
                        </div>
                        <div class="w-2/5">
                            <input 
                                id="e-planning-tidak" 
                                v-model="ePlanning" 
                                value="1" 
                                type="radio" 
                                name="e_planning" 
                                />
                            <label 
                                for="e-planning-tidak" 
                                class="cursor-pointer">
                                Tidak
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full my-4 mb-10">
                <button 
                    class="flex bg-blue-400 text-white shadow-lg outline-none focus:outline-none hover:bg-blue-300 shadow-md px-4 py-2 items-center rounded-lg" 
                    @click="onClickUploadDataPendukung">
                    <i class="fa fa-paperclip mr-2"></i> 
                    {{this.fileDataPendukung.name ? this.fileDataPendukung.name : "Data pendukung"}}
                </button>
                <input 
                    type="file" 
                    class="h-8 outline-none hidden border-b w-full" 
                    placeholder="Justifikasi" 
                    ref="fileDataPendukung" 
                    @change="onChangeFileDataPendukung"
                    >
            </div>   
            <div class="w-full my-4 absolute bottom-0 ">
                <button 
                    class="bg-indigo-400 outline-none 
                    focus:outline-none hover:shadow-lg rounded-lg px-2 py-2 text-white" 
                    @click="onClickSimpanPerencanaan">
                    Simpan
                </button>
            </div>  
        </div>  
    `
})

Vue.component('forminputSitou',{
    props: ['showforminputdata', 'pageactive'],
    data: () => {
        return {
            showFormInputContentData : true,
        }
    },
    created(){
        this.showFormInputContentData = true
    },
    methods: {
        toggleFormInput(){
            this.showFormInputContentData = !this.showFormInputContentData
        },
        onClickCloseForm(){
            this.$parent.onClickCloseForm()
        },
    },
    template: `
        <div class="absolute shadow-2xl w-2/5 lg:w-2/5 md:w-3/5  mr-10 bg-white rounded-t-lg overflow-hidden right-0 bottom-0 border" v-if="showforminputdata">
            <div class="w-full flex text-white px-4 p-2 bg-gray-700 cursor-pointer" @click.self="toggleFormInput">
                <div class="w-3/5" @click.self="toggleFormInput">
                    <div class="text-sm" @click.self="toggleFormInput">
                       <div class="">
                            {{pageactive == 'mainmenu' ? 'Adakah yang anda rencanakan..??' : (pageactive == 'detaillistpersetujuan' ? 'Validasi' : '')}}
                       </div>
                    </div>
                </div>
                <div class="w-2/5 flex justify-end">
                    <div class="h-6 w-6 rounded-full hover:bg-gray-600 text-center" @click="onClickCloseForm"> 
                        <i class="fa fa-times"></i>
                    </div>
                </div>
            </div>
            <div class="w-full pt-4 px-4 pb-10" v-if="showFormInputContentData">
                <wrapper-form-input-perencanaan v-if="pageactive == 'mainmenu' ? true : false"></wrapper-form-input-perencanaan> 
                <wrapper-form-input-persetujuan v-if="pageactive == 'detaillistpersetujuan' ? true : false"></wrapper-form-input-persetujuan> 
                <wrapper-form-input-alkes v-if="pageactive == 'masteralkes' ? true : false"></wrapper-form-input-alkes>
            </div>
        </div>
    `
})

Vue.component('masteralkesSitou',{
    data: () => {
        return {
            namaAlkes: ""
        }
    },
    methods: {
       
    },
    template: `
        <div class="w-full px-2 py-4 h-screen overflow-y-scroll">
            <div class="w-full flex py-4 px-2 border-b mb-2">
                <div class="w-2/3">
                    <h1 class="text-xl font-medium">Daftar Alkes E-Planning</h1>
                </div>
                <div class="w-1/3">
                    <input 
                    v-model="namaAlkes"
                    type="text" 
                    class="float-right rounded-lg w-full h-10 bg-gray-300 px-2 focus:outline-none" 
                    placeholder="Cari Alkes">
                </div>
            </div>
            <div class="w-full">
                <list-alkes-sitou :search="namaAlkes"></list-alkes-sitou>
            </div>
        </div>
    `
})

Vue.component('listAlkesSitou', {
    props: ['search'],
    data: () => {
        return {
            tempDataAllMasterAlkes: [],
            dataAllMasterAlkes: [],
            loader: false
        }
    },
    created(){
        this.loadMasterAlkes()
    },
    watch: {
        search: function (newVal , oldVal){
            this.dataAllMasterAlkes = this.tempDataAllMasterAlkes.filter((data) => data.nama_alat_kesehatan.toLowerCase().match(newVal))
        }
    },
    methods: {
        loadMasterAlkes(){
            this.loader = true
            axios.get('/api/master-alkes',
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                if (response.status == 200){
                    
                    this.tempDataAllMasterAlkes = response.data
                    this.dataAllMasterAlkes = response.data
                } else {
                    
                }
                this.loader = false
            })
            .catch(function(error){
                console.log(error);
                this.loader = false
            });
        } 
    },
    template: `
        <div class="w-full">
            <div class="w-full px-2 font-light" v-if="loader">
                Mohon tunggu...
            </div>
            <div class="w-full px-2 font-light" v-if="dataAllMasterAlkes.length == 0 && loader == false ? true : false">
                Tidak Ada data
            </div>
            <div 
                class="flex pl-2 cursor-pointer hover:bg-gray-100 border-b py-3" 
                v-for="item in dataAllMasterAlkes" >
                <div class="w-4/5">
                    {{item.nama_alat_kesehatan}}
                </div>
            </div>
        </div>  
    `
})

Vue.component('masteruserSitou',{
    data: () => {
        return {
            showPassword: false,
            firstName: "",
            lastName: "",
            username: "",
            password: "",
            passwordConfirm: "",
            validation: {
                'error' : ''
            }
        }
    },
    methods: {
        onClickShowPassword(){
            this.showPassword = !this.showPassword
        },
        onClickSimpanUser(){
            if (this.password == this.passwordConfirm){
                axiosj.post('/api/user', {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    userName: this.username,
                    password: this.password,
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    },
    template: `
        <div class="w-full px-2 py-4 h-screen">
            <div class="w-full py-4 px-2">
                <h1>Buat Akun Sitou</h1>
            </div>
            <div class="w-full">
                <div class="w-full flex">
                    <input 
                        v-model="firstName"
                        ref="firstName"
                        type="text" 
                        class="rounded-lg pl-2 mx-2 outline-none w-1/3 h-10 bg-gray-200" 
                        placeholder="Nama Depan">
                    <input 
                        v-model="lastName"
                        ref="lastName"
                        type="text" 
                        class="rounded-lg pl-2 mx-2 outline-none w-1/3 h-10 bg-gray-200" 
                        placeholder="Nama Belakang">
                </div>
                <div class="w-full mt-10" >
                    <input 
                        v-model="username"
                        ref="username"
                        type="text" 
                        class="rounded-lg pl-2 mx-2 outline-none w-1/3 h-10 bg-gray-200" 
                        placeholder="Nama Pengguna">

                </div>
                <div class="w-full pl-2">
                    <span class="text-xs ">Anda dapat menggunakan huruf, angka & titik</span>
                </div>
                <div class="w-full mt-10" >
                    <input 
                        v-model="password"
                        ref="password"
                        :type="showPassword ? 'text' : 'password'" 
                        class="rounded-lg pl-2 mx-2 outline-none w-1/3 h-10 bg-gray-200" 
                        placeholder="Sandi">
                    <input 
                        v-model="passwordConfirm"
                        ref="passwordConfirm"
                        :type="showPassword ? 'text' : 'password'" 
                        class="rounded-lg pl-2 mx-2 outline-none w-1/3 h-10 bg-gray-200" 
                        placeholder="Konfirmasi">
                    <button 
                        @click="onClickShowPassword" 
                        class="h-10 w-10 bg-gray-200 rounded-full focus:outline-none">
                        <i v-bind:class="{'fa-eye': !showPassword , 'fa-eye-slash': showPassword }" class="fa text-gray-800"></i>
                    </button>
                </div>
                <div class="w-full pl-2">
                    <span class="text-xs">Sebaiknya gunakan minimal 8 karakter dengan campuran huruf, angka & simbol</span>
                </div>
                <div class="w-full mt-4 pl-2" >
                    <button 
                        @click="onClickSimpanUser"
                        class="h-8 focus:outline-none rounded-full bg-blue-500 px-5 text-white"
                    >
                    Simpan
                </button>
                </div>
            </div>
        </div>
    `
})


Vue.component('mainmenuSitou',{
    data: () => {
        return {
            dataAllPerencanaan: [],
        }
    },
    mounted(){
        
    },
    created(){
        this.loadPerencanaan()
    },
    methods: {
        parentOnClickListPerencanaan(item){
            this.$parent.onClickListPerencanaan(item)
        },
        loadPerencanaan(){
            axios.get('/api/perencanaan',
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                if (response.status == 200){
                    this.dataAllPerencanaan = response.data
                    console.log(this.dataAllPerencanaan)
                } else {
                    
                }
            })
            .catch(function(error){
                console.log(error);
            });
        },
        refresh(){
            this.$parent.reRenderList('mainmenu')
        }
    },
    template: `
        <div class="w-full py-4 px-3 h-screen">
            <div class="w-full flex border-b pb-2">
                <div class="w-1/5">
                    <div class="w-8 h-8 hover:bg-gray-300 text-center pt-1 rounded-full cursor-pointer" @click="refresh">
                        <i class="fa fa-redo text-gray-800"></i>
                    </div>
                </div>
                <div class="w-4/5">
                </div>
            </div>
            <!-- <div class="w-full flex border-b">
                <div class="w-1/3 py-3 px-2 cursor-pointer hover:bg-gray-200">
                    <div class="text-red-800 font-medium">
                        Utama
                    </div>
                </div>
                <div class="w-1/3 px-2 py-3 cursor-pointer hover:bg-gray-200">
                    
                </div>
                <div class="w-1/3 px-2 py-3 cursor-pointer hover:bg-gray-200">
                    
                </div>
            </div> -->
            <div class="w-full h-full overflow-y-scroll ">
                <list-perencanaan-sitou></list-perencanaan-sitou>
            </div>
        </div>
    `
})


Vue.component('loadersubmitSitou',{
    props: ['showif', 'loadermessage', 'showclosebutton'],
    methods: {
        onClickCloseLoader(){
            this.$parent.hideLoaderSubmit()
        }
    },
    template: `
        <div 
            class="absolute left-0 mx-6 my-6 py-3 px-6 rounded text-white text-sm bottom-0 bg-gray-900" 
            v-if="showif"
            >
            {{loadermessage}} 
            <button 
                class="h-6 w-6 hover:bg-gray-700 rounded-full focus:outline-none" 
                v-if="showclosebutton" 
                @click="onClickCloseLoader"
                >
                <i class="fa fa-times"></i>
            </button>
        </div>
    `
})

Vue.component('listPerencanaanSitou', {
    data: () => {
        return {
            dataAllPerencanaan: [],
            loading: false
        }
    },
    created(){
        this.loadPerencanaan()
    },
    methods: {
        parentOnClickListPerencanaan(idTrxPerencanaan){
            this.$parent.$parent.onClickListPerencanaan(idTrxPerencanaan)
        },
        loadPerencanaan(){
            this.loading = true
            axios.get('/api/perencanaan',
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                if (response.status == 200){
                    this.loading = false
                    this.dataAllPerencanaan = response.data
                    console.log(this.dataAllPerencanaan)
                } else {
                    this.loading = false
                }
            })
            .catch(function(error){
                console.log(error);
            });
        } ,
        onClickDeletePerencanaan(idTrxPerencanaan){
            this.$parent.$parent.showLoaderSubmit('Menghapus data...')
            axios.delete('/api/perencanaan',
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
                data: {
                    id_trx_perencanaan: idTrxPerencanaan
                }
            }
            ).then((response) => {
                if (response.status == 200){
                    this.$parent.$parent.showLoaderSubmit('Data berhasil di hapus...', true)
                    this.$parent.$parent.reRenderList('mainmenu')
                } else {
                    this.$parent.$parent.hideLoaderSubmit()
                }
            })
            .catch(function(error){
                console.log(error);
            });
        }
    },
    template: `
        <div class="w-full h-auto pb-32">
            <div class="w-full mt-4" v-if="loading">Mengambil data...</div>
            <div class="flex cursor-pointer hover:bg-gray-100 border-b py-3" v-for="item in dataAllPerencanaan" @click.self="parentOnClickListPerencanaan(item)">
                <div class="w-2/6 pl-2 " @click.self="parentOnClickListPerencanaan(item)">
                    {{item.eplanning == '0' ? item.nama_alkes.substring(0,50)+(item.nama_alkes.length >= 50 ? "..." : '') : item.nama_alkes_mst_alkes.substring(0,50)+(item.nama_alkes.length >= 50 ? "..." : '')}}
                </div>
                <div class="w-2/6" @click.self="parentOnClickListPerencanaan(item)">
                    {{item.justifikasi}}
                </div>
                <div class="w-2/6 pr-4 " @click.self="parentOnClickListPerencanaan(item)">
                    <button v-if="item.valid_status == '' ? true : false" class="focus:outline-none hover:bg-red-400 bg-red-500 h-10 w-10 text-white rounded-full float-right" @click="onClickDeletePerencanaan(item.id_trx_perencanaan)"><i class="fa fa-trash"></i></button>
                    <div class="text-white rounded-lg float-right px-4 py mr-4" v-bind:class="item.valid_status == '' ? 'bg-blue-400' : item.valid_status == '1' ? 'bg-green-500' : 'bg-red-400'">
                        {{item.valid_status == "" ? "Belum Di Verifikasi" : (item.valid_status == "1" ? "Valid" : "Pending")}} 
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
        </div>
    `
})

Vue.component('detaillistperencanaanSitou',{
    data: () => {
        return {
            detailPerencanaan: null,
            fileDataPendukung: null,
            inputKomentar: '',
            startKomentar: '',
            dataAllKomentar: []
        }
    },
    mounted() {
        this.loadKomentar()
    },
    methods: {

        loadKomentar(){

            let config = {
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
                  'Access-Control-Allow-Origin': '*',
                  'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                }
            }

            var self = this
            // alert(self.detailPerencanaan.id_message_telegram)

            axios.post('/api/komentar-perencanaan', Qs.stringify({
                id_message_telegram: self.detailPerencanaan.id_message_telegram,
            }), config)
            .then(function (response) {
                // console.log(response);
                let newKomentar = []
                if (response.status == 200){
                    let a = response.data.map((r) => {
                        // console.log(r)
                        r.profile_picture = `/images/${r.profile_picture}`
                        newKomentar.push(r)
                    })
                    self.dataAllKomentar = newKomentar 
                }
            })
            .catch(function (error) {
                console.log(error);
            });


            // axios.get('/api/komentar',
            // {
            //     headers: {
            //         'Access-Control-Allow-Origin': '*',
            //         'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
            //     },
            // }
            // ).then((response) => {
            //     if (response.status == 200){
            //         this.dataAllKomentar = response.data
            //         console.log(this.dataAllKomentar)
            //     } else {
                    
            //     }
            // })
            // .catch(function(error){
            //     console.log(error);
            // });
        },

        onClickBack(){
            this.$parent.changeActivePage('mainmenu')
        },

        onClickPostKomentar() {
            alert(this.detailPerencanaan.id_message_telegram)
            const config = {
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                }
            }

            var self = this

            axios.post('/api/komentar-percakapan', Qs.stringify({
                id_trx_perencanaans: this.detailPerencanaan.id_trx_perencanaan,
                komentar: `${this.inputKomentar}`,
                id_message_telegram: this.detailPerencanaan.id_message_telegram,
                to_id_telegram: 683727335,
                from_id_telegram: 631646828
            }), config)

            .then(function (response) {
                console.log(response);
                self.loadKomentar()
            })
            .catch(function (error) {
                console.log(error);
            }); 
            

        },

        onClickSentToPimpinanTelegram() {

            const config = {
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                }
            }

            axios.post('/api/komentar', Qs.stringify({
                id_trx_perencanaans: this.detailPerencanaan.id_trx_perencanaan,
                komentar: this.startKomentar,
                // to_id_telegram: 683727335,
                to_id_telegram: 631646828,
                from_id_telegram: 631646828
            }), config)

            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        moment: function () {
            return moment();
        }

    },
    created(){
        this.detailPerencanaan = this.$parent.getChosenItemPerencanaan()
        this.fileDataPendukung = '/images/'+this.detailPerencanaan.file_data_pendukung
        this.startKomentar = `${this.detailPerencanaan.nama_alkes}, 
        Justifikasi: ${this.detailPerencanaan.justifikasi}, Quantity:
        ${this.detailPerencanaan.kuantitas}@Rp.${this.detailPerencanaan.harga} pengaju ${this.$parent._data.session.first_name} ${this.$parent._data.session.last_name}`
    },
    template: `
    <div class="w-full py-4 px-2 h-screen overflow-y-scroll" id="wrapper-detailPerencanaan">
            <div class="w-full pb-2 border-b">
                <div class="h-10 w-10 rounded-full cursor-pointer hover:bg-gray-200 text-center pt-2 text-gray-600 hover:text-gray-800" @click="onClickBack">
                    <i class="fa fa-arrow-left"></i>
                </div>
            </div>
            <div class="py-2 px-2">
                <div class="text-3xl font-light text-gray-900">
                    {{this.detailPerencanaan.nama_alkes}}
                </div>
                <span class="text-xs" >Tanggal Usulan : {{moment(this.detailPerencanaan.date_created).format('DD-MM-YYYY HH:mm:ss')}}</span>
            </div>
            <div class="px-2 flex border-b pb-4">

                <div class="w-1/3">
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Kuantitas
                        </div>
                        <div class="w-1/3">
                            : {{this.detailPerencanaan.kuantitas}}
                        </div>
                    </div>
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Harga Satuan
                        </div>
                        <div class="w-1/3">
                            : {{this.detailPerencanaan.harga}}
                        </div>
                    </div>
                    <div class="flex font-light mt-2">
                        <div class="w-1/3 ">
                            Justifikasi 
                        </div>
                        <div class="w-2/3 ">
                            : {{this.detailPerencanaan.justifikasi}}
                        </div>
                    </div>
                    
                </div>
                <div class="w-1/3">
                    <div class="flex font-light mt-2">
                            <div class="w-1/3">
                                Mudah Rusak
                            </div>
                            <div class="w-1/3">
                                : 
                                <span class="" v-if="detailPerencanaan.mudah_rusak == 1 ? true : false">Ya</span>
                                <span class="" v-if="detailPerencanaan.mudah_rusak == 0 ? true : false">Tidak</span>
                            </div>
                        </div>  
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Mudah Hilang
                        </div>
                        <div class="w-1/3">
                            : 
                            <span class="" v-if="detailPerencanaan.mudah_hilang == 1 ? true : false">Ya</span>
                            <span class="" v-if="detailPerencanaan.mudah_hilang == 0 ? true : false">Tidak</span>
                        </div>
                    </div>      
                </div>
                <div class="w-1/3">
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Umur Aset
                        </div>
                        <div class="w-1/3">
                            : {{this.detailPerencanaan.umur_aset}}
                        </div>
                    </div>
                    <div class="flex font-light mt-4">
                        <div class="w-1/3">
                            E-Planning
                        </div>
                        <div class="w-1/3">
                            : 
                            <span class="" v-if="detailPerencanaan.eplanning == 1 ? true : false">Ya</span>
                            <span class="" v-if="detailPerencanaan.eplanning == 0 ? true : false">Tidak</span>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="py-2 overflow-y-scroll">
                <div class="w-full flex border-b pb-2">
                    <div class="w-4/5">
                        Data Pendukung
                    </div>
                    <div class="w-1/5">
                        <button 

                        class="rounded text-xs bg-blue-400  text-white font-bold p-2 uppercase border-green-500" 
                        v-on:click="onClickSentToPimpinanTelegram()"
                        v-if="detailPerencanaan.id_message_telegram == ''"
                        >Kirim ke telegram pimpinan</button> 


                    </div>
                </div>
                <div class="w-full flex">
                    <div class="w-4/6">
                        <iframe :src="fileDataPendukung" width="100%" height="100%"></iframe>
                    </div>
                    <div class="w-2/6 h-screen">
                        <div class="w-full ">

                            <div class="pb-6 px-4 flex-none">
                                <div class="flex rounded-lg border-2 border-grey overflow-hidden">
                                <span class="text-3xl text-grey border-r-2 border-grey p-2" v-on:click="onClickPostKomentar()">
                                    <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"/></svg>
                                </span>
                                <input type="text" class="w-full px-4" placeholder="Komentar #alasan" v-model="inputKomentar" />
                                </div>
                            </div> 
                            
                            <div class="pt-4 px-4" v-for="komentar in dataAllKomentar" v-bind:key="komentar.id">

                                <div class="flex items-start mb-4 text-sm">
                                    <img :src=komentar.profile_picture class="w-10 h-10 rounded mr-3">
                                    <div class="flex-1 overflow-hidden">
                                        <div>
                                            <span class="font-bold">{{komentar.username}}</span>
                                            <span class="text-grey text-xs">{{komentar.date_created}} - dari telegram</span>
                                        </div>
                                        <p class="text-black leading-normal">{{komentar.komentar}}</p>
                                    </div>
                                </div>


                            </div>
            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    `
})

Vue.component('persetujuanSitou',{
    data: () => {
        return {
            dataAllPersetujuan: [],
            activePagePersetujuan: 'semua'
        }
    },
    mounted(){
        
    },
    methods: {
        reRenderList(){
            this.$parent.reRenderList('persetujuan')
        },
        changePagePersetujuan(activePage){
            this.activePagePersetujuan = activePage
        }
    },
    template: `
        <div class="w-full py-4 px-3 h-screen">
            <div class="w-full flex border-b pb-2">
                <div class="w-1/5">
                    <div class="w-8 h-8 hover:bg-gray-300 text-center pt-1 rounded-full cursor-pointer" @click="reRenderList">
                        <i class="fa fa-redo text-gray-800"></i>
                    </div>
                </div>
                <div class="w-4/5">
                </div>
            </div>
            <div class="w-full flex border-b">
                <div 
                class="w-1/4 py-3 px-2 cursor-pointer hover:bg-gray-200" 
                @click="changePagePersetujuan('semua')" 
                v-bind:class="activePagePersetujuan == 'semua' ? 'border-b-2 border-red-500' : ''">
                    <div class="font-medium" v-bind:class="activePagePersetujuan == 'semua' ? 'text-red-800' : 'text-gray-600'">
                        Semua
                    </div>
                </div>
                <div 
                class="w-1/4 px-2 py-3 cursor-pointer hover:bg-gray-200" 
                @click="changePagePersetujuan('menunggu')"
                v-bind:class="activePagePersetujuan == 'menunggu' ? 'border-b-2 border-red-500' : ''">
                    <div class="font-medium" v-bind:class="activePagePersetujuan == 'menunggu' ? 'text-red-800' : 'text-gray-600'">
                        Menunggu Persetujuan
                    </div>
                </div>
                <div 
                class="w-1/4 px-2 py-3 cursor-pointer hover:bg-gray-200" 
                @click="changePagePersetujuan('valid')"
                v-bind:class="activePagePersetujuan == 'valid' ? 'border-b-2 border-red-500' : ''">
                    <div class="font-medium" v-bind:class="activePagePersetujuan == 'valid' ? 'text-red-800' : 'text-gray-600'">
                        Valid
                    </div>
                </div>
                <div 
                class="w-1/4 px-2 py-3 cursor-pointer hover:bg-gray-200" 
                @click="changePagePersetujuan('tidakvalid')"
                v-bind:class="activePagePersetujuan == 'tidakvalid' ? 'border-b-2 border-red-500' : ''">
                    <div class="font-medium" v-bind:class="activePagePersetujuan == 'tidakvalid' ? 'text-red-800' : 'text-gray-600'">
                        Pending
                    </div>
                </div>
            </div>
            <div class="w-full overflow-y-auto ">
                <listall-persetujuan-sitou :activepage="activePagePersetujuan"></listall-persetujuan-sitou>
            </div>
        </div>
    `
})

Vue.component('listallPersetujuanSitou', {
    props: ['activepage'],
    data: () => {
        return {
            tempDataAllPersetujuan: [],
            dataAllPersetujuan: [],
            loader: false
        }
    },
    created(){
        this.loadPersetujuan()
    },
    watch: {
        activepage: function (newVal , oldVal){
            if (newVal == 'menunggu'){
                this.dataAllPersetujuan = this.tempDataAllPersetujuan.filter(data => data.valid_status == "") 
            } 
            else
            if (newVal == 'valid'){
                this.dataAllPersetujuan = this.tempDataAllPersetujuan.filter(data => data.valid_status == "1")
            }
            else 
            if (newVal == 'tidakvalid'){
                this.dataAllPersetujuan = this.tempDataAllPersetujuan.filter(data => data.valid_status == "0") 
            } 
            else {
                this.dataAllPersetujuan = this.tempDataAllPersetujuan
            }
        }
    },
    methods: {
        parentOnClickListPersetujuan(item){
            this.$parent.$parent.onClickListPersetujuan(item)
        },
        loadPersetujuan(){
            this.loader = true
            axios.get('/api/perencanaan',
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
                },
            }
            ).then((response) => {
                this.loader= false
                if (response.status == 200){
                    this.dataAllPersetujuan = response.data
                    this.tempDataAllPersetujuan = response.data
                    console.log(this.dataAllPersetujuan)
                } else {
                    
                }
            })
            .catch(function(error){
                this.loader = false 
                console.log(error);
            });
        }
    },
    template: `
        <div class="w-full">
            <div class="w-full px-2 py-4" v-if="loader">
                Mengambil data perencanaan...
            </div>
            <div class="flex cursor-pointer hover:bg-gray-100 border-b py-3" v-if="loader == false ? true : false" v-for="item in dataAllPersetujuan" @click.self="parentOnClickListPersetujuan(item)">
                <div class="w-2/6 pl-2 " @click.self="parentOnClickListPersetujuan(item)">
                    {{item.nama_alkes.substring(0,50)+(item.nama_alkes.length >= 50 ? "..." : '')}}
                </div>
                <div class="w-2/6" @click.self="parentOnClickListPersetujuan(item)">
                    {{item.justifikasi}}
                </div>
                <div class="w-2/6 pr-4" @click.self="parentOnClickListPersetujuan(item)">
                    <div class="text-white float-right rounded-lg float-right px-4 py mr-4" v-bind:class="item.valid_status == '' ? 'bg-blue-400' : item.valid_status == '1' ? 'bg-green-500' : 'bg-red-400'">
                        {{item.valid_status == "" ? "Belum Di Verifikasi" : (item.valid_status == "1" ? "Valid" : "Pending")}} 
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="text-white rounded-lg bg-blue-400 float-right px-4 py mr-4" v-if="item.valid_status != '' && item.valid_status != '0' ? true : false">
                        {{'Prioritas '+item.prioritas}} 
                    </div>
                </div>

            </div>
            
        </div>
    `
})

Vue.component('detaillistpersetujuanSitou',{
    data: () => {
        return {
            detailPersetujuan: null,
            fileDataPendukung: null
        }
    },
    methods: {
        onClickBack(){
            this.$parent.changeActivePage('persetujuan')
        },
        onClickValidasi(){
            this.$parent.showFormInput()
        },
        moment: function () {
            return moment();
        },
    },
    created(){
        this.detailPersetujuan = this.$parent.getChosenItemPersetujuan()
        this.fileDataPendukung = '/images/'+this.detailPersetujuan.file_data_pendukung
    },
    template: `
        <div class="w-full py-4 px-2 h-screen overflow-y-scroll" id="wrapper-detailPersetujuan">
            <div class="w-full flex pb-2 border-b">
                <div class="w-1/2">
                    <div class="h-10 w-10 rounded-full cursor-pointer hover:bg-gray-200 text-center pt-2 text-gray-600 hover:text-gray-800" @click="onClickBack">
                        <i class="fa fa-arrow-left"></i>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="float-right rounded-lg cursor-pointer bg-green-600 px-2 py-2 text-white hover:bg-green-400" @click="onClickValidasi">
                        Validasi <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
            <div class="py-2 px-2 border-b">
                <div class="text-3xl font-light text-gray-900">
                    {{this.detailPersetujuan.nama_alkes}}
                </div>
                <div class="text-sm font-light">
                    Nama user penginput : alfian lensun
                </div>
                <div class="text-xs font-light">
                    Tanggal Usulan : {{moment(this.detailPersetujuan.date_created).format('DD-MM-YYYY HH:mm:ss')}}
                </div>
            </div>
            <div class="px-2 flex border-b pb-4">
                <div class="w-1/3">
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Kuantitas
                        </div>
                        <div class="w-2/3">
                            : {{this.detailPersetujuan.kuantitas}}
                        </div>
                    </div>
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Harga Satuan
                        </div>
                        <div class="w-2/3">
                            : {{this.detailPersetujuan.harga}}
                        </div>
                    </div>
                    <div class="flex font-light mt-2">
                        <div class="w-1/3 ">
                            Justifikasi 
                        </div>
                        <div class="w-2/3 ">
                            : {{this.detailPersetujuan.justifikasi}}
                        </div>
                    </div>
                </div>
                <div class="w-1/3">
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Mudah Rusak
                        </div>
                        <div class="w-1/3">
                            : 
                            <span class="" v-if="detailPersetujuan.mudah_rusak == 1 ? true : false">Ya</span>
                            <span class="" v-if="detailPersetujuan.mudah_rusak == 0 ? true : false">Tidak</span>
                        </div>
                    </div>
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Mudah Hilang
                        </div>
                        <div class="w-1/3">
                            : 
                            <span class="" v-if="detailPersetujuan.mudah_hilang == 1 ? true : false">Ya</span>
                            <span class="" v-if="detailPersetujuan.mudah_hilang == 0 ? true : false">Tidak</span>
                        </div>
                    </div>
                </div>
                <div class="w-1/3">
                    <div class="flex font-light mt-2">
                        <div class="w-1/3">
                            Umur Aset
                        </div>
                        <div class="w-1/3">
                            : {{this.detailPersetujuan.umur_aset}}
                        </div>
                    </div>
                    <div class="flex mt-2 font-light">
                        <div class="w-1/3">
                            E-Planning
                        </div>
                        <div class="w-1/3">
                            : 
                            <span class="" v-if="detailPersetujuan.eplanning == 1 ? true : false">Ya</span>
                            <span class="" v-if="detailPersetujuan.eplanning == 0 ? true : false">Tidak</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2 overflow-y-scroll">
                <div class="w-full flex border-b pb-2">
                    Data Pendukung
                </div>
                <div class="w-full py-4 flex ">
                    <div class="w-4/6">
                        <iframe :src="fileDataPendukung" width="100%" height="100%"></iframe>
                    </div>
                    <div class="w-2/6 h-screen">
                        <div class="w-full">
                            <div class="pt-4 px-4">
                                <div class="flex items-start mb-4 text-sm">
                                    <img src="/images/vm.jpg" class="w-10 h-10 rounded mr-3">
                                    <div class="flex-1 overflow-hidden">
                                        <div>
                                            <span class="font-bold">Victor Mongi</span>
                                            <span class="text-grey text-xs">11:46 - dari aplikasi</span>
                                        </div>
                                        <p class="text-black leading-normal">Mohon untuk verifikasi permintaan alat kesehatan ini.</p>
                                    </div>
                                </div>
            
                                <div class="flex items-start mb-4 text-sm">
                                    <img src="/images/vm.jpg" class="w-10 h-10 rounded mr-3">
                                    <div class="flex-1 overflow-hidden">
                                        <div>
                                            <span class="font-bold">Victor Mongi</span>
                                            <span class="text-grey text-xs">12:42 - dari telegram</span>
                                        </div>
                                        <p class="text-black leading-normal">Mohon untuk verifikasi permintaan alat kesehatan ini.</p>
                                    </div>
                                </div>
                            </div>
            
                            <div class="pb-6 px-4 flex-none">
                                <div class="flex rounded-lg border-2 border-grey overflow-hidden">
                                <span class="text-3xl text-grey border-r-2 border-grey p-2">
                                    <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"/></svg>
                                </span>
                                <input type="text" class="w-full px-4" placeholder="Komentar #alasan" />
                                </div>
                            </div> 
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    `
})


Vue.component('laporanSitou',{
    data: () => {
        return {
            tempDataAllPerencanaan: [],
            dataAllPerencanaan: [],
            activePageLaporan: 'laporan',
            enablePrint: false,
            optionLaporan: [
                {
                    idLaporan: 1,
                    keterangan: 'Hari Ini'
                },
                {
                    idLaporan: 2,
                    keterangan: 'Bulan Ini'
                },
                {
                    idLaporan: 3,
                    keterangan: 'Tahun Ini'
                },
                {
                    idLaporan: 4,
                    keterangan: 'Valid'
                },
                {
                    idLaporan: 5,
                    keterangan: 'Pending'
                },
                {
                    idLaporan: 6,
                    keterangan: 'Belum Verifikasi'
                },
                {
                    idLaporan: 7,
                    keterangan: 'E-Planning'
                },
                {
                    idLaporan: 8,
                    keterangan: 'Bukan E-Planning'
                },
                {
                    idLaporan: 9,
                    keterangan: 'Semua'
                },
            ],
            idLaporan: {
                idLaporan: 9,
                keterangan: 'Semua'
            },
            loader: false
        }
    },
    created(){
        this.loader = true
        axios.get('/api/perencanaan',
        {
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Authorization': `Bearer ${document.cookie.match('(^|;) ?token=([^;]*)(;|$)')}` 
            },
        }
        ).then((response) => {
            if (response.status == 200){
                
                this.tempDataAllPerencanaan = response.data
                this.enablePrint = true
                this.dataAllPerencanaan = response.data
                console.log(this.dataAllPerencanaan)
            } 
            this.loader = false
        })
        .catch(function(error){
            this.loader = false
            console.log(error);
        });
    },
    
    methods: {
        changePageLaporan(activePage){
            this.activePageLaporan = activePage
        },
        print(){
            if (this.enablePrint == true){
                if (this.activePageLaporan == 'laporan'){
                    this.$htmlToPaper('print')
                } else {
                    this.$htmlToPaper('printQR')
                }
            }
        },
        onChangeFilter(){
            if (this.idLaporan != null){
                if (this.idLaporan.idLaporan == 1){
                    let tanggal = moment(new Date()).format('YYYY-MM-DD')
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => moment(data.date_created).format('YYYY-MM-DD') == tanggal) 
                }
                else
                if (this.idLaporan.idLaporan == 2){
                    let tanggal = moment(new Date()).format('YYYY-MM')
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => moment(data.date_created).format('YYYY-MM') == tanggal) 
                }
                else 
                if (this.idLaporan.idLaporan == 3){
                    let tanggal = moment(new Date()).format('YYYY')
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => moment(data.date_created).format('YYYY') == tanggal) 
                }
                else 
                if (this.idLaporan.idLaporan == 4){
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => data.valid_status == 1) 
                }
                else
                if (this.idLaporan.idLaporan == 5){
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => data.valid_status == 0) 
                }
                else
                if (this.idLaporan.idLaporan == 6){
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => data.valid_status == "") 
                }
                else
                if (this.idLaporan.idLaporan == 7){
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => data.eplanning == "0") 
                }
                else
                if (this.idLaporan.idLaporan == 8){
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan.filter(data => data.eplanning == "1") 
                }
                else
                if (this.idLaporan.idLaporan == 9){
                    this.dataAllPerencanaan = this.tempDataAllPerencanaan
                }
            }
        },
        moment: function () {
            return moment();
        }
    },
    template: `
        <div class="w-full px-2 py-4 h-screen overflow-y-scroll">
            <div class="w-full py-4 flex border-b" >
                <div class="w-1/6 px-2">
                    <h1 class="font-medium text-xl">Laporan</h1>
                </div>
                <div class="w-2/6 hide-on-print">
                    <div class="w-full">
                        <v-select 
                            label="Jenis Laporan" 
                            :filterable="false" 
                            :options="optionLaporan"  
                            v-model="idLaporan" 
                            @input="onChangeFilter"
                            >
                            <template slot="no-options">
                                Pilih Laporan
                            </template>
                            <template slot="option" slot-scope="option">
                                <div class="d-center">
                                {{ option.keterangan }}
                                </div>
                            </template>
                            <template slot="selected-option" slot-scope="option">
                                <div class="selected d-center">
                                {{ option.keterangan }}
                                </div>
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="w-2/6 hide-on-print"></div>
                <div class="w-1/6 hide-on-print">
                    <div class="w-full">
                        <button class="float-right bg-blue-300 px-2 py-2 focus:outline-none text-white" v-bind:class="{'bg-blue-500': enablePrint , 'hover:bg-blue-400' : enablePrint}" @click='print'>Cetak <i class="fa fa-print"></i></button>
                    </div>
                </div>
            </div>
            <div class="w-full flex hide-on-print">
                <div 
                class="w-1/4 py-3 px-2 cursor-pointer hover:bg-gray-200" 
                @click="changePageLaporan('laporan')" 
                v-bind:class="activePageLaporan == 'laporan' ? 'border-b-2 border-red-500' : ''">
                    <div class="font-medium" v-bind:class="activePageLaporan == 'laporan' ? 'text-red-800' : 'text-gray-600'">
                        Laporan
                    </div>
                </div>
                <div 
                class="w-1/4 px-2 py-3 cursor-pointer hover:bg-gray-200" 
                @click="changePageLaporan('QR')"
                v-bind:class="activePageLaporan == 'QR' ? 'border-b-2 border-red-500' : ''">
                    <div class="font-medium" v-bind:class="activePageLaporan == 'QR' ? 'text-red-800' : 'text-gray-600'">
                        QR Code
                    </div>
                </div>
            </div>
            <div class="w-full px-2 py-4" v-if="loader">
                Mengambil data laporan...
            </div>
            <div class="w-full" id="print" v-if="activePageLaporan == 'laporan' && loader == false ? true  : false">
                <div class="w-full">
                    <div class="text-lg px-2 py-4 show-on-print hidden">
                        Laporan <i class="fa fa-file text-gray-600 ml-3"></i>
                    </div>
                </div>
                <div class="w-full flex border-b">
                    <div class="w-1/6 flex  border-on-print">
                        <div class="w-1/4 pl-2 py-2 border-right-on-print">
                            No
                        </div>
                        <div class="w-3/4 pl-2 py-2">
                            Tanggal Usulan
                        </div>
                    </div>
                    <div class="w-1/6 pl-2 py-2 border-on-print">
                        Nama Alkes
                    </div>
                    <div class="w-1/6 pl-2 py-2 border-on-print">
                        Kategori
                    </div>
                    <div class="w-1/6 pl-2 py-2 border-on-print">
                        Umur Aset
                    </div>
                    <div class="w-1/6 pl-2 py-2 border-on-print">
                        Kuantitas
                    </div>
                    <div class="w-1/6 pl-2 py-2 border-on-print">
                        Harga Satuan
                    </div>
                </div>
                <div class="w-full" v-for="(item, index) in dataAllPerencanaan">
                    <div class="w-full flex">
                        <div class="w-1/6 flex border-on-print">
                            <div class="w-1/4 border-right-on-print ">
                                {{index+1}}
                            </div>
                            <div class="w-3/4">
                                {{moment(item.date_created).format('DD-MM-YYYY')}}
                            </div>
                        </div>
                        <div class="w-1/6 pl-2 py-2 border-on-print">
                            {{item.eplanning == 0 ? item.nama_alkes : item.nama_alkes_mst_alkes}}
                        </div>
                        <div class="w-1/6 pl-2 py-2 border-on-print">
                            {{item.nama_kategori}}
                        </div>
                        <div class="w-1/6 pl-2 py-2 border-on-print">
                            {{item.umur_aset}}
                        </div>
                        <div class="w-1/6 pl-2 py-2 border-on-print">
                            {{item.kuantitas}}
                        </div>
                        <div class="w-1/6 pl-2 py-2 border-on-print">
                            {{item.harga}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full" id="printQR" v-if="activePageLaporan == 'QR' && loader == false ? true  : false">
                    <div class="w-full flex border-b">
                        <div class="w-1/6 flex  border-on-print">
                            <div class="w-1/4 pl-2 py-2 border-right-on-print">
                                No
                            </div>
                            <div class="w-3/4 pl-2 py-2">
                                Tanggal Usulan
                            </div>
                        </div>
                        <div class="w-3/6 pl-2 py-2 border-on-print">
                            Nama Alkes
                        </div>
                        <div class="w-2/6 border-on-print">
                            QR
                        </div>
                    </div>
                    <div class="w-full" v-for="(item, index) in dataAllPerencanaan">
                        <div class="w-full flex">
                            <div class="w-1/6 flex border-on-print">
                                <div class="w-1/4 border-right-on-print ">
                                    {{index+1}}
                                </div>
                                <div class="w-3/4">
                                    {{moment(item.date_created).format('DD-MM-YYYY')}}
                                </div>
                            </div>
                            <div class="w-3/6 pl-2 py-2 border-on-print">
                                {{item.eplanning == 0 ? item.nama_alkes : item.nama_alkes_mst_alkes}}
                            </div>
                            <div class="w-2/6 border-on-print">
                                <qrcode :value="item.id_user_inputer" :options="{ width: 200 }"></qrcode>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    `
})

Vue.component('rkaklSitou', {
    template: `
        <div class="w-full">
            <div class="w-full mx-2 my-4 pb-2 border-b">
                <h1>Panduan RKAKL</h1>
            </div>
            <div class="w-full">
                <iframe src="" width="100%" height="100%"></iframe>
            </div>
        </div>
    `
})