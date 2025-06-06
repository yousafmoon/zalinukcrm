import { AbilityBuilder, createMongoAbility } from '@casl/ability';

export function defineAbilitiesFor(roles) {
  const { can, build } = new AbilityBuilder(createMongoAbility);
  if (!Array.isArray(roles)) {
    roles = [roles]; 
  }
  const validRoles = roles.filter(role => {
    let roleName = null;
    if (typeof role === 'object' && role !== null && role?.name) {
      roleName = role.name;
    } else if (typeof role === 'string') {
      roleName = role;
    }
    return roleName && roleName !== 'Guest' && typeof roleName === 'string' && roleName.trim().length > 0;
  });
  validRoles.forEach(role => {
    const roleName = typeof role === 'object' && role?.name ? role.name : role;
    if (roleName === 'admin') {
      can('view', 'Dashboard');
      can('view', 'Students');
      can('view', 'Documents');
      can('view', 'Leads');
      can('view', 'Permissions');
      can('view', 'Roles');
      can('view', 'Users');
    } else if (roleName === 'Editor') {
      can('view', 'Dashboard');
      can('view', 'Students');
    } else if(roleName === 'staff') {
      can('view', 'Dashboard');
      can('view', 'Students');
    } else {
      console.log('Unknown role:', roleName); 
    }
  });

  const abilities = build();
  return abilities;
}
