import { Card } from '@/Components/Card';
import { FC, useState } from 'react';
import ReactApexChart from 'react-apexcharts';
import { VisitsPerVehicleChartProps, VisitsPerVehicleProps } from './types';

export const VisitsPerVehicle: FC<VisitsPerVehicleProps> = ({ vehicles }) => {
  const sortedVehicles = vehicles.sort((a, b) => {
    if (a.visits < b.visits) {
      return 1;
    } else if (a.visits > b.visits) {
      return -1;
    }
    return 0;
  });
  const [chartState] = useState<VisitsPerVehicleChartProps>({
    options: {
      chart: {
        type: 'bar',
        height: 350,
        events: {
          dataPointSelection: (event, chartContext, config) => {
            const vehicle = sortedVehicles[config.dataPointIndex];
            window.open(
              `https://raposoautoshopping.com.br/${vehicle.type}/${vehicle.slug}`,
              '_blank',
            );
          },
        },
      },
      plotOptions: {
        bar: {
          borderRadius: 4,
          borderRadiusApplication: 'end',
          horizontal: true,
        },
      },
      dataLabels: {
        enabled: false,
      },
      xaxis: {
        categories: sortedVehicles.map((vehicle) => vehicle.title),
      },
    },
    series: [
      {
        data: sortedVehicles.map((vehicle) => vehicle.visits),
      },
    ],
  });

  return (
    <Card>
      <div className="text-xl font-bold">Visitas</div>
      <ReactApexChart
        options={chartState.options}
        series={chartState.series}
        type="bar"
        height={350}
      />
    </Card>
  );
};
