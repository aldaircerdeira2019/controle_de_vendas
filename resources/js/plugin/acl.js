const Acl = class {
    constructor(user) {
      this.user=user;
    }

    permissions(){
      return  this.user.permissions.map(permission =>permission.name);
    }

    hasPermissionTo(string){
      return this.permissions().includes(string);
    }
  };

  export default {Acl};
