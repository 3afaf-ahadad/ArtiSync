import { useEffect, useState } from 'react';
import api from '../api/axios';

const Machines = () => {
  const [machines, setMachines] = useState([]);

  useEffect(() => {
    // Appel à ton API Laravel (vérifie que ta route est bien 'machines')
    api.get('/machines')
      .then(response => setMachines(response.data))
      .catch(error => console.error("Erreur chargement machines:", error));
  }, []);

  return (
    <div className="space-y-6">
      <h1 className="text-2xl font-bold text-[#5E503F]">Machines</h1>
      
      <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table className="w-full text-left">
          <thead className="bg-gray-50 border-b border-gray-100">
            <tr>
              <th className="p-4 font-semibold text-gray-600">Nom</th>
              <th className="p-4 font-semibold text-gray-600">Statut</th>
            </tr>
          </thead>
          <tbody>
            {machines.map(machine => (
              <tr key={machine.id} className="border-b border-gray-50">
                <td className="p-4">{machine.name}</td>
                <td className="p-4">
                    <span className="px-2 py-1 rounded-full text-xs font-medium bg-status-green-bg text-status-green-text">
                        {machine.status}
                    </span>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default Machines;