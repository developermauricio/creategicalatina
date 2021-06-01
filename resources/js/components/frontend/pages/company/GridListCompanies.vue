<template>
    <div>
        <div v-if="skeletonValue == 1">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3 pt-3" v-for="skele in 6">
                    <SkeletonScaffold
                        :primary="colorCardLoading"
                        borderRadius="0px"
                        animTimingFunction="ease-in">
                        <div v-mBox v-mDark style="height: 1.5em"></div>
                        <br/>
                        <div v-mCardImg></div>
                    </SkeletonScaffold>
                </div>
            </div>
        </div>
        <div class="row pt-1 pb-3">
            <div class="col-12 demo-inline-spacing">
                <div class="icon-search-wrapper mx-auto" style="margin-left: 0px !important;">
                    <div class="input-group input-group-merge" style="width: 22rem !important;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="icons-search" v-model="searchQuery"
                               :placeholder="$t('backend.team.teams.texto_buscar_input')"/>
                    </div>
                </div>
                <a type="button" :href="'/'+language+'/new-member'"
                   class="float-right btn btn-primary waves-effect waves-float waves-light"><i data-feather='plus'
                                                                                               class="mr-1"></i>{{
                        $t('backend.team.teams.registrar_miembro')
                    }}</a>
            </div>
        </div>
        <div class="row" v-if="skeletonValue === 0">
            <div class="col-12 col-md-3 col-lg-3" v-for="(company, index) in resultQuery" :key="company.id">
                <div class="card card-profile">
                    <img :src="bannerTeam" class="img-fluid card-img-top"
                         alt="Profile Cover Photo"/>
                    <div class="card-body">
                        <div class="profile-image-wrapper">
                            <div class="profile-image">
                                <div class="avatar">
                                    <img :src="company.picture" alt="Profile Picture"/>
                                </div>
                            </div>
                        </div>
                        <h3 v-text="company.name"></h3>
                        <h6 class="text-muted" v-text="company.email"></h6>
                        <div class="badge badge-light-primary profile-badge team-position" v-text="company.category.name[language]">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "GridListCompanies",
    data() {
        return {
            searchQuery: null,
            skeletonValue: 1,
            picture: null,
            bannerTeam: window.banner_team,
            colorCardLoading: window.cardsLoadingColor, //color de las tarjetas cargando segun el tema
            position: [
                {
                    team_position: null
                }
            ],
            companies: [],
            language: window.lang
        }
    },
    methods: {
        getListCompanies() {
            axios.get('/api/get-companies-customer')
                .then(resp => {
                    setTimeout(() => {
                        this.skeletonValue = 0
                    }, 200)
                    this.companies = resp.data.data
                    console.log(this.companies)
                }).catch(err => {
                this.skeletonValue = 0
            })
        }
    },
    mounted() {
        this.getListCompanies()
    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                return this.companies.filter((item) => {
                    return this.searchQuery.toLowerCase().split(' ').every(v =>
                        item.name.toLowerCase().includes(v) || item.email.toLowerCase().includes(v),
                    )
                })
            } else {
                return this.companies;
            }
        }
    }
}
</script>

<style scoped>

</style>
