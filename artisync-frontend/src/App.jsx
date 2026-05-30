import { BrowserRouter, Routes, Route } from "react-router-dom";
import DashboardLayout from "./layouts/DashboardLayout";
import Machines from "./pages/Machine";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<DashboardLayout />}>
          {/* Les vraies pages viendront remplacer ces divs plus tard */}
          <Route
            index
            element={
              <div className="text-2xl font-bold text-[#5E503F]">
                Tableau de Bord (Bientôt)
              </div>
            }
          />
          <Route path="machines" element={<Machines />} />
          <Route
            path="settings"
            element={
              <div className="text-2xl font-bold text-[#5E503F]">
                Paramètres (Bientôt)
              </div>
            }
          />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
