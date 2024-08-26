import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import Layout from '@/Shared/Layout';
import SearchFilter from '@/Shared/SearchFilter';
import Pagination from '@/Shared/Pagination';

const Index = () => {
  const { records, balance } = usePage().props;
  const {
    data,
    meta: { links }
  } = records;
  
  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Records</h1>
      <h1 className="mb-8 text-1xl font-bold">Current Balance: {balance}</h1>
      <div className="flex items-center justify-between mb-6">
        <SearchFilter />
      </div>
      <div className="overflow-x-auto bg-white rounded shadow">
        <table className="w-full whitespace-nowrap">
          <thead>
            <tr className="font-bold text-left">
            <th className="px-6 pt-5 pb-4">Operation</th>
              <th className="px-6 pt-5 pb-4">Amount Spent</th>
              <th className="px-6 pt-5 pb-4">Balance</th>
              <th className="px-6 pt-5 pb-4" colSpan="2">
                Response
              </th>
            </tr>
          </thead>
          <tbody>
            {data.map(({ id, type, amount, user_balance, operation_response, created_at }) => {
              return (
                <tr
                  key={id}
                  className="hover:bg-gray-100 focus-within:bg-gray-100"
                >
                  <td className="border-t">
                  <div className='flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none'>
                      {type}
                      </div>
                  </td>
                  <td className="border-t">
                      <div className='flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none'>
                        {amount}
                      </div>
                  </td>
                  <td className="border-t">
                    <div className='flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none'>
                    {user_balance}
                    </div>
                  </td>
                  <td className="border-t">
                    <div className='flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none'>
                    {operation_response}
                    </div>
                  </td>
                </tr>
              );
            })}
            {data.length === 0 && (
              <tr>
                <td className="px-6 py-4 border-t" colSpan="4">
                  No records found.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      <Pagination links={links} />
    </div>
  );
};

Index.layout = page => <Layout title="Records" children={page} />;

export default Index;
