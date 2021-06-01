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
                        <input type="text" class="form-control" id="icons-search" v-model="searchQuery" :placeholder="$t('backend.team.teams.texto_buscar_input')" />
                    </div>
                </div>
                <a type="button" :href="'/'+language+'/new-member'" class="float-right btn btn-primary waves-effect waves-float waves-light"><i data-feather='plus' class="mr-1"></i>{{ $t('backend.team.teams.registrar_miembro') }}</a>
            </div>
        </div>
        <div class="row" v-if="skeletonValue === 0">
            <div v-if="resultQuery" class="col-12 col-md-3 col-lg-3" v-for="(team, index) in resultQuery" :key="team.id">
                <div class="card card-profile">
                    <img :src="bannerTeam" class="img-fluid card-img-top"
                         alt="Profile Cover Photo"/>
                    <div class="card-body">
                        <div class="profile-image-wrapper">
                            <div class="profile-image">
                                <div class="avatar">
                                    <img :src="team.user.picture" alt="Profile Picture"/>
                                </div>
                            </div>
                        </div>
                        <h3 v-text="team.user.name"></h3>
                        <h6 class="text-muted" v-text="team.user.email"></h6>
                        <!--                    <div class="badge badge-light-primary profile-badge">{{ team.team_position.map((resp) => { return resp.name[language]}) }}</div>-->
                        <div class="badge badge-light-primary profile-badge team-position ml-1"
                             style="margin-bottom: 0px !important;" v-for="(positions, index) in team.team_position">
                            {{ positions.name[language] }}
                        </div>

                    </div>
                </div>
            </div>
            <div v-else>
                <h3>{{ $t('backend.team.teams.texto_no_hay_miembros') }}</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "GridListTeam",
    data() {
        return {
            searchQuery: null,
            name: '',
            lastName: '',
            skeletonValue: 1,
            picture: null,
            bannerTeam: window.banner_team,
            colorCardLoading: window.cardsLoadingColor, //color de las tarjetas cargando segun el tema
            position: [
                {
                    team_position: null
                }
            ],
            teams: [],
            language: window.lang
        }
    },
    methods: {
        getListTeam() {
            axios.get('/api/grid-list-team')
                .then(resp => {
                    setTimeout(() => {
                        this.skeletonValue = 0
                    }, 200)
                    this.teams = resp.data.data
                    console.log(this.teams)
                }).catch(err => {
                this.skeletonValue = 0
            })
        }
    },
    mounted() {
        this.getListTeam()
    },
    computed: {
        resultQuery(){
            if(this.searchQuery){
                return this.teams.filter((item)=>{
                    return this.searchQuery.toLowerCase().split(' ').every(v =>
                        item.user.name.toLowerCase().includes(v) || item.user.email.toLowerCase().includes(v),
                    )
                })
            }else{
                return this.teams;
            }
        }
    }
}
</script>

<style scoped>

</style>
