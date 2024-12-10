import { Card } from '@/Components/Card';
import { FC } from 'react';
import ReactApexChart from 'react-apexcharts';
import { VehicleLimitProps } from './types';

export const VehicleLimit: FC<VehicleLimitProps> = ({
  max,
  used,
  title,
  icon,
}) => {
  const options: ApexCharts.ApexOptions = {
    chart: {
      type: 'radialBar',
      height: 80,
    },
    plotOptions: {
      radialBar: {
        offsetY: 0,
        startAngle: -90,
        endAngle: 90,
        hollow: {
          margin: 0,
          background: 'transparent',
        },
        track: {
          background: '#f2f2f2',
          strokeWidth: '90%',
        },
        dataLabels: {
          name: {
            show: false,
          },
          value: {
            show: true,
            fontSize: '24px',
            fontWeight: 'bold',
            color: '#111',
          },
        },
      },
    },
    labels: ['Consumo'],
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: '100%',
          },
        },
      },
    ],
    series: [(100 / (max ?? 100)) * used],
  };

  return (
    <Card className="flex gap-4 items-center">
      <ReactApexChart
        options={options}
        series={options.series}
        type="radialBar"
        height={180}
      />
      <div className="flex gap-4 items-center">
        <div className="rounded-full bg-slate-900 text-white p-2">{icon}</div>
        <div>
          <h3 className="text-xl font-bold">
            {used}
            <span className="text-black/40 text-sm">/{max}</span>
          </h3>
          <p className="text-sm text-slate-400">{title}</p>
        </div>
      </div>
    </Card>
  );
};
