<template>
    <div>
        <v-app id="inspire" v-if="$gate.isAdmin()">
            <v-navigation-drawer
                v-model="drawer"
                :clipped="$vuetify.breakpoint.lgAndUp"
                app
                color="blue-grey darken-3"
                dark
            >
                <v-img :aspect-ratio="16 / 9" src="/img/dashboard.JPG">
                    <v-row
                        align="end"
                        class="lightbox white--text pa-2 fill-height"
                    >
                        <v-col cols="12" sm="12" md="3" v-if="profiles.photo">
                            <v-avatar size="50">
                                <v-img
                                    dark
                                    v-bind:src="mypic + profiles.photo"
                                    aspect-ratio="1.7"
                                    contain
                                ></v-img>
                            </v-avatar>
                        </v-col>
                        <v-col cols="12" sm="12" md="9">
                            <div class="subheading">
                                {{ users.name }} ({{ users.type }})
                            </div>
                            <div class="subheading">{{ users.email }}</div>
                        </v-col>
                    </v-row>
                </v-img>

                <template>
                    <v-list-item
                        dense
                        v-for="(item, index) in uitems"
                        :key="index"
                        :to="item.link"
                    >
                        <v-row
                            v-if="item.heading"
                            :key="item.heading"
                            align="center"
                        >
                            <v-col cols="6">
                                <v-subheader v-if="item.heading">{{
                                    item.heading
                                }}</v-subheader>
                            </v-col>
                            <v-col cols="6" class="text-center">
                                <a href="#!" class="body-2 black--text">EDIT</a>
                            </v-col>
                        </v-row>
                        <v-list-item v-else :key="item.text" link>
                            <v-list-item-action>
                                <v-icon>{{ item.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>{{
                                    item.text
                                }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item>
                </template>
            </v-navigation-drawer>

            <v-app-bar
                :clipped-left="$vuetify.breakpoint.lgAndUp"
                app
                color="blue-grey darken-4"
                dark
            >
                <v-app-bar-nav-icon
                    @click.stop="drawer = !drawer"
                ></v-app-bar-nav-icon>
                <v-toolbar-title style="width: 300px" class="ml-0 pl-4" dark>
                    <span class="hidden-sm-and-down pointme" @click="gotohome"
                        >eVoting</span
                    >
                    <br />
                </v-toolbar-title>
                <v-spacer></v-spacer>
                Login At: {{ users.login_at | myDate }}

                <v-menu offset-y>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon v-bind="attrs" v-on="on">
                            <v-icon size="35">mdi-account</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item
                            v-for="(pitem, index) in pitems"
                            :key="index"
                            :to="pitem.link"
                            @click="logmeout(pitem.key)"
                        >
                            <v-list-item-action>
                                <v-icon>{{ pitem.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>{{
                                    pitem.text
                                }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-app-bar>
            <v-content>
                <v-container fluid>
                    <router-view></router-view>
                </v-container>
            </v-content>
        </v-app>
        <div v-if="$gate.isUser()">
            <div v-if="!wait">
                <voting-component></voting-component>
            </div>
            <div v-if="wait">
                <wait-component></wait-component>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        source: String
    },
    data: () => ({
        compo: "compodashboard",
        drawer: null,
        wait: false,
        mypic: "img/profile/",
        users: [],
        notifies: [],
        profiles: [],

        uitems: [
            {
                icon: "mdi-view-dashboard",
                text: "Dashboard",
                key: "dashboard",
                link: "/"
            },
            {
                icon: "mdi-format-list-bulleted",
                text: "Notification",
                link: "/notification"
            },
            {
                icon: "mdi-note-multiple",
                text: "Candidates",
                link: "/candidates"
            },
            {
                icon: "mdi-format-list-bulleted",
                text: "Voters",
                link: "/users"
            }
        ],

        pitems: [
            {
                icon: "mdi-face-profile",
                text: "Login Profile",
                key: "profile",
                link: "/profile"
            },
            { icon: "mdi-logout", text: "Logout", key: "logout" }
        ]
    }),
    created() {
        this.loadUsers();
    },
    methods: {
        update(compo) {
            this.compo = compo;
        },
        gotohome() {
            window.location.href = "/";
        },
        logmeout(key) {
            if (key == "logout") {
                window.location.assign(APP_URL + "/logout");
            }
            if (key == "profile") {
                this.compo = "compoprofile";
            }
            console.log(key);
        },
        loadUsers() {
            axios.get("api/authuser").then(({ data }) => (this.users = data));
        }
    }
};
</script>
<style scoped>
.v-navigation-drawer {
    transition: none !important;
}
.pointme {
    cursor: pointer;
}
.lightbox {
    box-shadow: 0 0 20px inset rgba(0, 0, 0, 0.2);
    background-image: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.4) 0%,
        transparent 72px
    );
}
@media (max-width: 767px) {
    .desktop {
        display: none;
    }
}
</style>
