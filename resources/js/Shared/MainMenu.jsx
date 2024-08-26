import React from 'react';
import MainMenuItem from '@/Shared/MainMenuItem';

export default ({ className }) => {
  return (
    <div className={className}>
      <MainMenuItem text="Users" link="users" icon="users" />
      <MainMenuItem text="Records" link="records" icon="office" />
      <MainMenuItem text="Calculator" link="calculator" icon="office" />
    </div>
  );
};
