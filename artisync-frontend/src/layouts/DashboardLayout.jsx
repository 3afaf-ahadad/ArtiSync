import { Outlet } from "react-router-dom";
import Sidebar from "../components/Sidebar";
import Topbar from "../components/Topbar";

const DashboardLayout = () => {
  return (
    <div className="flex h-screen w-full bg-[#F3F4F6]">
      <Sidebar />
      <div className="flex-1 flex flex-col h-screen overflow-hidden">
        <Topbar />
        <main className="flex-1 overflow-y-auto p-8">
          <Outlet /> 
        </main>
      </div>
    </div>
  );
};

export default DashboardLayout;