import { NavLink } from "react-router-dom";
import { LayoutDashboard, Settings, Wrench } from "lucide-react";
import logo from "../assets/LOGO.svg";

const Sidebar = () => {
  const menuItems = [
    { name: "Tableau de bord", icon: LayoutDashboard, path: "/" },
    { name: "Machines", icon: Wrench, path: "/machines" },
    { name: "Paramètres", icon: Settings, path: "/settings" },
  ];

  return (
    <aside className="w-64 h-screen bg-[#FAF8F5] border-r border-gray-200 flex flex-col">
      <div className="p-6 flex items-center gap-3">
        <img src={logo} alt="ArtiSync Logo" className="w-8 h-8 object-contain" />
      </div>

      <nav className="flex-1 px-4 mt-6">
        {menuItems.map((item) => (
          <NavLink
            key={item.name}
            to={item.path}
            className={({ isActive }) =>
              `flex items-center gap-3 px-4 py-3 mb-2 rounded-lg transition-colors ${
                isActive
                  ? "bg-white text-[#8B5A2B] shadow-sm font-medium"
                  : "text-gray-500 hover:bg-white/50 hover:text-[#8B5A2B]"
              }`
            }
          >
            <item.icon size={20} />
            <span>{item.name}</span>
          </NavLink>
        ))}
      </nav>
    </aside>
  );
};

export default Sidebar;
