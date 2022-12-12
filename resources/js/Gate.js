export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'Admin';
    }
 
    isUser(){
        return this.user.type === 'User';
    }

}