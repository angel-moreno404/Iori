export default class Gate{

    constructor(user){

this.user=user;

    }

    isAdmin(){

        if(this.user.type   ===  'admin'){
            return true;
        }
    }

    isUser(){

        return this.user.type   ===  'user';
    }

    isAuthor(){

        return this.user.type   ===  'author';
    }

    isAdminORAuthor(){

        if(this.user.type   ===  'admin' || this.user.type   ===  'author'){
            return true;
        }
    }
    isAuthororUser(){

        if(this.user.type   ===  'user' || this.user.type   ===  'author'){
            return true;
        }
    }

}

