import React from 'react';
import { Link, useForm, usePage } from '@inertiajs/react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';

const Create = () => {
  const { operations } = usePage().props;
  
  const { data, setData, errors, post, processing } = useForm({
    operation: '',
    value1: '',
    value2: ''
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('calculator.store'));
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        Calculator
      </h1>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex flex-wrap p-8 -mb-8 -mr-6">

          <SelectInput
           className="w-full pb-8 pr-6 lg:w-1/2"
           label="Operation"
            onChange={e => setData('operation', e.target.value)}
            name="operation"
            errors={errors.operation}
            value={data.operation}
          >
            <option value="">Select Operarion</option>
            {operations.map(op => (
              <option key={op.id} value={op.id}>{op.type}</option>
            ))}
          </SelectInput>
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Value 1"
              name="value1"
              type="text"
              errors={errors.value1}
              value={data.value1}
              onChange={e => setData('value1', e.target.value)}
            />
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Value 2"
              name="value2"
              type="text"
              errors={errors.value2}
              value={data.value2}
              onChange={e => setData('value2', e.target.value)}
            />
          </div>
          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              loading={processing}
              type="submit"
              className="btn-indigo"
            >
              Calculate
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Create.layout = page => <Layout title="Calculator" children={page} />;

export default Create;
