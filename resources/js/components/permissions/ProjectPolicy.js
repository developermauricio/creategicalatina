const find = function (array, name) {
    if (array && Array.isArray(array)) {

        return (array.findIndex(policy => (policy.name === name) ) !== -1);
    }
    return false;
}

export default class ProjectPolicy
{
    static addCustomerProject($user, project){
        return find(user.roles,'Administrator');
    }

}
