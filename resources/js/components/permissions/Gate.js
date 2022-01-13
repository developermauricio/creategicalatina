import ProjectPolicy from "./ProjectPolicy";


export default class Gate
{
    constructor(user, roles)
    {
        this.roles = roles;
        this.user = Object.assign({rolesTxt: roles}, user);
        this.policies = {
            project: ProjectPolicy,
        };
    }

    before()
    {

        return this.user.role === 'Administrator';
    }

    allow(action, type, model = null)
    {
        if (this.before()) {
            return true;
        }

        return this.policies[type][action](this.user, model);
    }

    deny(action, type, model = null)
    {
        return ! this.allow(action, type, model);
    }
}
